<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\DirectoryRequest;

use App\CmsDirectory;

use View;

class DirectoryController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;

		$directories = CmsDirectory::select()
					->where('name', 'LIKE', '%'.$filter.'%')
					->Paginate();

		View::share('filter', $filter);
        
        return view('admin.directory.index', array('directories'=>$directories));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$ftypes = \App\CmsFileType::select()->get()->pluck('name', 'id');
		View::share('ftypes', $ftypes);

        return view('admin.directory.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(DirectoryRequest $request)
	{

		$directory = CmsDirectory::Create($request->all());

		\App\Util\RegisterLog::add($directory);
		return redirect('admin/directory/');
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
		$directory = CmsDirectory::FindOrFail($id);
		$ftypes = \App\CmsFileType::select()->get()->pluck('name', 'id');
		View::share('ftypes', $ftypes);

        return view('admin.directory.edit', compact('directory'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(DirectoryRequest $request, $id)
	{
		$directory = CmsDirectory::FindOrFail($id);
		$directory->fill($request->all());
		$directory->active = $request->active;
		$directory->save();

		\App\Util\RegisterLog::add($directory);
		return redirect('admin/directory/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$directory = CmsDirectory::FindOrFail($id);
		$directory->delete();

		\App\Util\RegisterLog::add($directory);
		return redirect('admin/directory/');
	}

}
