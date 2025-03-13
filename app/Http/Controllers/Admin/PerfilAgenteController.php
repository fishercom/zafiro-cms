<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\PerfilAgenteRequest;

use App\Models\CrmPerfilAgente;
use App\Models\CmsParameter;

use View;

class PerfilAgenteController extends AdminController
{
    public function __construct(){
        $tipoagentes = CmsParameter::select()
            ->whereHas('group', function($query){
                $query->where('alias', 'tipoagente');
            })
            ->pluck('name', 'id');//Get From Parameters

		View::share('tipoagentes', $tipoagentes);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;

		$perfiles = CrmPerfilAgente::select()
			->where('name', 'LIKE', '%'.$filter.'%')
			->orderBy('id')
			->Paginate();

		View::share('filter', $filter);

        return view('admin.perfilagente.index', array('perfiles'=>$perfiles));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$perfilagente=new CrmPerfilAgente(Request::all());
		$perfilagente->active = '1';

        return view('admin.perfilagente.create', compact('perfilagente'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PerfilAgenteRequest $request)
	{
		$perfilagente = CrmPerfilAgente::Create($request->all());

		\App\Util\RegisterLog::add($perfilagente);
		return redirect('admin/perfilagente/');
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
		$perfilagente = CrmPerfilAgente::FindOrFail($id);

        return view('admin.perfilagente.edit', compact('perfilagente'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PerfilAgenteRequest $request, $id)
	{
		$perfilagente = CrmPerfilAgente::FindOrFail($id);
		$perfilagente->fill($request->all());
		$perfilagente->active = $request->active;
		$perfilagente->save();

		\App\Util\RegisterLog::add($perfilagente);
		return redirect('admin/perfilagente/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$perfilagente = CrmPerfilAgente::FindOrFail($id);
		$perfilagente->delete();

		\App\Util\RegisterLog::add($perfilagente);
		return redirect('admin/perfilagente/');
	}
}
