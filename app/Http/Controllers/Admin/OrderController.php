<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\OrderRequest;
use Maatwebsite\Excel\Facades\Excel;

use App\Order;
use App\User;
use App\Member;
use App\Company;
use App\CmsSite;
use App\Util\BladeExport;

use View;
use Config;

class OrderController extends AdminController
{
    public $module_params;

    public function __construct()
    {
        $page = Request::get('page');
        $this->module_params = null;

        View::share('page', $page);
        View::share('module_params', $this->module_params);
    }

    public function index()
    {
        $start_date = Request::get('start_date');
        $end_date = Request::get('end_date');
        $status = Request::get('status');
        $filter = Request::get('filter');

        $orders = Order::with(['member'])
            ->where(function($query) use($start_date, $end_date, $status, $filter){
                if(!empty($start_date)) $query->where('created_at', '>=', $start_date);
                if(!empty($end_date)) $query->where('created_at', '<', date('Y-m-d', strtotime($end_date.' +1 days')));
                if(!empty($status)) $query->where('status', $status);
                if(!empty($filter)){
                    $q='%'.str_replace(' ', '%', $filter).'%';
                    $query->orWhereIn('member_id', 
                        Member::whereIn('user_id', 
                            User::where('name', 'LIKE', $q)->orWhere('lastname', 'LIKE', $q)->pluck('id')
                        )->pluck('id'));
                    $query->orWhereIn('member_id', 
                        Company::where('name', 'LIKE', $q)->orWhere('ruc', $filter)->pluck('member_id')
                    );
                }
            })
            ->orderBy('created_at', 'desc');

        if(Request::has('export')){
            return Excel::download(new BladeExport($orders->get(), 'admin.order.excel'), 'Orders_'.date('dmY').'.xlsx');
        }

            $orders=$orders->Paginate()
            ->appends([
                'start_date'=>$end_date,
                'end_date'=>$end_date,
                'status'=>$status,
                'filter'=>$filter
            ]);

        $status_list = Config::get('constants.order_status');

        View::share('start_date', $start_date);
        View::share('end_date', $end_date);
        View::share('status', $status);
        View::share('filter', $filter);
        
        return view('admin.order.index', compact('orders', 'status_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $order=new Order(Request::all());
        $order->active = '1';

        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(OrderRequest $request)
    {

        $order = Order::Create($request->all());
        $order->active = $request->active;
        $order->save();

        \App\Util\RegisterLog::add($order);
        return redirect('admin/order/'.$this->module_params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::FindOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $order = Order::FindOrFail($id);

        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(OrderRequest $request, $id)
    {
        $order = Order::FindOrFail($id);
        $order->fill($request->all());
        $order->active = $request->active;
        $order->save();

        \App\Util\RegisterLog::add($order);
        return redirect('admin/order/'.$this->module_params);
    }

    public function update_easap($id)
    {
        $order = App\Order::find($id);
        $results = App\Util\WSEASAP::post_order($order);

        return redirect('admin/order/'.$this->module_params)->with('results', $results);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $order = Order::FindOrFail($id);
        $order->delete();

        \App\Util\RegisterLog::add($order);
        return redirect('admin/order/');
    }

}
