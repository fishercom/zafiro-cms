<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\TranslateRequest;

use App\Models\CmsLang;
use App\Models\CmsTranslate;

use View;

class TranslateController extends AdminController {

	public $lang;
	public $module_params;

    public function __construct()
    {
		$lang_id = Request::input('lang_id');
		$this->lang = !empty($lang_id)? \App\Models\CmsLang::find($lang_id): \App\Models\CmsLang::select()->where('active', '1')->first();

		$this->module_params = '?lang_id='.$this->lang->id;

		View::share('lang', $this->lang);
		View::share('module_params', $this->module_params);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::input('filter');
		$lang_iso	= $this->lang->iso;
		$lang_id	= $this->lang->id;

		$langs=CmsLang::select()->where('active', '1')->pluck('name', 'id');

		$translates=CmsTranslate::select('id', 'alias', 'metadata->'.$lang_iso.' as name', 'metadata', 'created_at', 'updated_at')
			->where('alias', 'LIKE', '%'.$filter.'%')
			->orderBy('alias')
			->Paginate()
			->appends([
				'lang_id'=>$lang_id
			]);

		View::share('filter', $filter);

        return view('admin.translate.index', compact('translates', 'langs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$translate=new CmsTranslate(Request::all());

        return view('admin.translate.create', compact('translate'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TranslateRequest $request)
	{
		$translate = CmsTranslate::greate($request->all());

		\App\Util\RegisterLog::add($translate);
		return redirect('admin/translate/'.$this->module_params);
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
		$translate = CmsTranslate::find($id);

        return view('admin.translate.edit', compact('translate'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(TranslateRequest $request, $id)
	{
		$translate = CmsTranslate::find($id);
		$translate->fill($request->all());
		$translate->save();

		\App\Util\RegisterLog::add($translate);
		return redirect('admin/translate/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$translate = CmsTranslate::find($id);
		$translate->delete();

		\App\Util\RegisterLog::add($translate);
		return redirect('admin/translate/'.$this->module_params);
	}

}
