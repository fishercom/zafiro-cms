<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\LangRequest;

use App\CmsLang;

use View;

class LangController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;

		$langs = CmsLang::select()
			->where('name', 'LIKE', '%'.$filter.'%')
			->Paginate();

		View::share('filter', $filter);
        
        return view('admin.lang.index', array('langs'=>$langs));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $lang=new CmsLang(Request::all());
        $lang->active = '1';

        return view('admin.lang.create', compact('lang'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(LangRequest $request)
	{

		$lang = CmsLang::Create($request->all());

		\App\Util\RegisterLog::add($lang);
		return redirect('admin/lang/');
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
		$lang = CmsLang::FindOrFail($id);

        return view('admin.lang.edit', compact('lang'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(LangRequest $request, $id)
	{
		$lang = CmsLang::FindOrFail($id);
		$lang->fill($request->all());
		$lang->active = $request->active;
		$lang->save();

		\App\Util\RegisterLog::add($lang);
		return redirect('admin/lang/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$lang = CmsLang::FindOrFail($id);
		$lang->delete();

		\App\Util\RegisterLog::add($lang);
		return redirect('admin/lang/');
	}

}
