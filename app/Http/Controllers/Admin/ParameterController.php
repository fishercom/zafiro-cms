<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\ParameterRequest;
use App\Http\Requests\Admin\SortableRequest;

use App\CmsLang;
use App\CmsParameter;
use App\CmsParameterLang;
use App\CmsParameterGroup;

use View;
use DB;

class ParameterController extends AdminController {

//	public $lang_id;
	public $group_id;
	public $parent_id;
	public $module_params;

    public function __construct()
    {
		$this->group_id = Request::input('group_id');
		$this->parent_id = Request::input('parent_id');

		if( !Request::has('group_id') ) $this->group_id = CmsParameterGroup::where('active', '1')->first()->id;

		$this->module_params = '?group_id='.$this->group_id.'&parent_id='.$this->parent_id;

		View::share('group_id', $this->group_id);
		View::share('parent_id', $this->parent_id);
		View::share('module_params', $this->module_params);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter  	= Request::input('filter');
		$group_id	= $this->group_id;
		$parent_id 	= $this->parent_id;

		$groups=CmsParameterGroup::select()->where('active', '1')->pluck('name', 'id');

		$list=CmsParameter::where('parent_id', $parent_id)
			->where(function($query) use($filter){
				$query->where('name', 'LIKE', '%'.$filter.'%');
			})
			->where('group_id', $group_id)
			->orderBy('position', 'asc');

		$parameters = $list->get();
		$parameters_pg = $list
			->Paginate()
			->appends([
				'group_id'=>$group_id,
				'parent_id'=>$parent_id,
			]);

		View::share('filter', $filter);

        return view('admin.parameter.index', compact('parameters', 'parameters_pg', 'groups'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$parameter = new CmsParameter(Request::all());
		$parameter->active = '1';

        return view('admin.parameter.create', compact('parameter'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ParameterRequest $request)
	{

        $parameter = CmsParameter::Create($request->all());
        $parameter->active = $request->active;
        $parameter->save();

		\App\Util\RegisterLog::add($parameter);
		return redirect('admin/parameter/'.$this->module_params);
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
		$parameter = CmsParameter::FindOrFail($id);
        return view('admin.parameter.edit', compact('parameter'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ParameterRequest $request, $id)
	{
		$parameter = CmsParameter::Find($id);
		$parameter->fill($request->all());
        $parameter->active = $request->active;
		$parameter->save();

		\App\Util\RegisterLog::add($parameter);
		return redirect('admin/parameter/'.$this->module_params);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function sort(SortableRequest $request)
	{
		$list=$request->sortlist;
		$i=1;
		foreach ($list as $id) {
			$parameter = CmsParameter::FindOrFail($id);
			$parameter->position = $i++;
			$parameter->save();
		}

		return redirect('admin/parameter/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$parameter = CmsParameter::FindOrFail($id);
		$parameter->delete();

		\App\Util\RegisterLog::add($parameter);
		return redirect('admin/parameter/'.$this->module_params);
	}

}
