<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\SiteRequest;

use App\Models\CmsSite;

use View;

class SiteController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $filter = Request::has('filter')? Request::input('filter'): NULL;

        $sites = CmsSite::select()
            ->where('name', 'LIKE', '%'.$filter.'%')
            ->Paginate();

        View::share('filter', $filter);
        
        return view('admin.site.index', array('sites'=>$sites));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $site=new CmsSite(Request::all());
        $site->active = '1';

        return view('admin.site.create', compact('site'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SiteRequest $request)
    {

        $site = CmsSite::Create($request->all());

        \App\Util\RegisterLog::add($site);
        return redirect('admin/site/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $site = CmsSite::FindOrFail($id);

        return view('admin.site.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(SiteRequest $request, $id)
    {
        $site = CmsSite::FindOrFail($id);
        $site->fill($request->all());
        $site->active = $request->active;
        $site->save();

        \App\Util\RegisterLog::add($site);
        return redirect('admin/site/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $site = CmsSite::FindOrFail($id);
        $site->delete();

        \App\Util\RegisterLog::add($site);
        return redirect('admin/site/');
    }

}
