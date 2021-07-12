<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\SchemaRequest;
use App\Http\Requests\Admin\SortableRequest;

use App\Models\CmsSchema;
use \App\Models\CmsSchemaGroup;

use View;

class SchemaController extends AdminController {
	
	public $parent;
	public $group;
	public $module_params;

    public function __construct()
    {
		$page = Request::get('page');
		$parent_id = Request::get('parent_id');
		$group_id = Request::get('group_id');
		if($parent_id==null)
			$this->parent = new CmsSchema;
		else
			$this->parent = CmsSchema::find($parent_id);

		if($group_id==null)
			$this->group = CmsSchemaGroup::where('default', true)->first();
		else
			$this->group = CmsSchemaGroup::find($group_id);

		$this->module_params = '?parent_id='.$this->parent->id.'&group_id='.$this->group->id;

		View::share('page', $page);
		View::share('parent', $this->parent);
		View::share('group', $this->group);
		View::share('module_params', $this->module_params);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = CmsSchemaGroup::where('active', true)->pluck('name', 'id');

		$list = CmsSchema::select()
			->where('parent_id', $this->parent->id)
			->where('group_id', $this->group->id)
			->orderBy('position', 'asc');

		$schemas = $list->get();
		$schemas_pg = $list
			->Paginate()
			->appends([
				'parent_id'=>$this->parent->id,
				'group_id'=>$this->group->id
			]);

        return view('admin.schema.index', compact('groups', 'schemas', 'schemas_pg'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$schema=new CmsSchema(Request::all());
		$schema->active = '1';

        return view('admin.schema.create', compact('schema'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SchemaRequest $request)
	{

		$schema = new CmsSchema;
		if ($this->parent->id!=null) $schema->parent_id = $this->parent->id;
		$schema->group_id = $this->group->id;
		$schema->name = $request->name;
		$schema->admin_view = $request->admin_view;
		$schema->front_view = $request->front_view;
		$schema->iterations = intval($request->iterations);
		$schema->is_page = $request->is_page;
		$schema->active = $request->active;
		$schema->save();

		\App\Util\RegisterLog::add($schema);
		return redirect('admin/schema/'.$this->module_params);
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
		$schema = CmsSchema::FindOrFail($id);

        return view('admin.schema.edit', compact('schema'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(SchemaRequest $request, $id)
	{
		$schema = CmsSchema::FindOrFail($id);
		$schema->name = $request->name;
		$schema->admin_view = $request->admin_view;
		$schema->front_view = $request->front_view;
		$schema->iterations = intval($request->iterations);
		$schema->is_page = $request->is_page;
		$schema->active = $request->active;
		$schema->save();

		\App\Util\RegisterLog::add($schema);
		return redirect('admin/schema/'.$this->module_params);
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
			$schema = CmsSchema::FindOrFail($id);
			$schema->position = $i++;
			$schema->save();
		}

		\App\Util\RegisterLog::add();
		return redirect('admin/schema/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$schema = CmsSchema::FindOrFail($id);
		$schema->delete();

		\App\Util\RegisterLog::add($schema);
		return redirect('admin/schema/'.$this->module_params);
	}

}
