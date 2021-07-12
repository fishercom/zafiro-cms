<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\RegisterRequest;

use App\Models\CmsRegister;
use App\Models\CmsRegisterField;
use App\Models\CmsForm;

use Maatwebsite\Excel\Facades\Excel;
use View;

class RegisterController extends AdminController {

	public $form;
	public $module_params;

    public function __construct()
    {
		$form_id = Request::input('form_id');
		$page = Request::input('page');
		$this->form = !empty($form_id)? \App\Models\CmsForm::find($form_id): \App\Models\CmsForm::select()->where('active', '1')->first();
		$this->module_params = '?form_id='.$this->form->id;

		View::share('form_id', $this->form->id);
		View::share('page', $page);

		View::share('module_params', $this->module_params);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;
		$sdate = Request::has('sdate')? Request::input('sdate'): date('Y-m-01');
		$edate = Request::has('edate')? Request::input('edate'): date('Y-m-d');

		$registers=CmsRegister::select()
			->where('form_id', $this->form->id)
			->where('created_at', '>=', $sdate)
			->where('created_at', '<', date('Y-m-d', strtotime($edate.' +1 days')))
			->where(function($query) use ($filter){
				$query->where('first_name', 'LIKE', '%'.strtolower($filter).'%');
				$query->orWhere('last_name', 'LIKE', '%'.strtolower($filter).'%');
				$query->orWhere('email', 'LIKE', '%'.strtolower($filter).'%');
				$query->orWhereNull('email');
             });

		if(Request::has('export')){
			return Excel::create('Registro_'.date('dmY'), function($excel) use($registers){
			    $excel->sheet('Lista', function($sheet) use($registers){
			        // Sheet manipulation
					//$sheet->fromArray($registers->get()->toArray());
					$sheet->loadView('admin.register.excel')
							->with('registers', $registers->get())
							->with('form_id', $this->form->id);
			    });
			})->download('xlsx');
		}

		$registers->Paginate()
			->appends([
				'form_id'=>$this->form->id
			]);

		$forms=CmsForm::select()->pluck('name', 'id');

		View::share('filter', $filter);
		View::share('sdate', $sdate);
		View::share('edate', $edate);

        return view('admin.register.index', array('registers'=>$registers->Paginate(), 'forms'=>$forms));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.register.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RegisterRequest $request)
	{
		$register = CmsRegister::Create($request->all());

		\App\Util\RegisterLog::add($register);
		return redirect('admin/register/'.$this->module_params);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$register = CmsRegister::FindOrFail($id);
		$fields = CmsRegisterField::Select()
					->Where('register_id', $id)
					->get();

        return view('admin.register.show', compact('register', 'fields'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$register = CmsRegister::FindOrFail($id);

        return view('admin.register.edit', compact('register'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(RegisterRequest $request, $id)
	{
		$register = CmsRegister::FindOrFail($id);
		$register->fill($request->all());
		$register->save();

		\App\Util\RegisterLog::add($register);
		return redirect('admin/register/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$register = CmsRegister::FindOrFail($id);
		$register->delete();

		\App\Util\RegisterLog::add($register);
		return redirect('admin/register/'.$this->module_params);
	}

}
