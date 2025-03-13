<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\CertificacionRequest;

use App\Models\CrmCertificacion;
use App\Models\CrmPerfilAgente;
use App\Models\CmsParameter;

use View;

class CertificacionController extends AdminController
{
    public function __construct(){
        $perfiles = CrmPerfilAgente::select()
            ->orderBy('name')
            ->pluck('name', 'id');

        $organizaciones = CmsParameter::select()
            ->whereHas('group', function($query){
                $query->where('alias', 'organizacion');
            })
            ->pluck('name', 'id');//Get From Parameters

		View::share(compact('perfiles','organizaciones'));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;

		$certificaciones = CrmCertificacion::select()
			->where('name', 'LIKE', '%'.$filter.'%')
			->orderBy('id')
			->Paginate();

		View::share('filter', $filter);

        return view('admin.certificacion.index', array('certificaciones'=>$certificaciones));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$certificacion=new CrmCertificacion(Request::all());
		$certificacion->active = '1';

        return view('admin.certificacion.create', compact('certificacion'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CertificacionRequest $request)
	{
		$certificacion = CrmCertificacion::Create($request->all());

		\App\Util\RegisterLog::add($certificacion);
		return redirect('admin/certificacion/');
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
		$certificacion = CrmCertificacion::FindOrFail($id);

        return view('admin.certificacion.edit', compact('certificacion'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CertificacionRequest $request, $id)
	{
		$certificacion = CrmCertificacion::FindOrFail($id);
		$certificacion->fill($request->all());
		$certificacion->active = $request->active;
		$certificacion->save();

		\App\Util\RegisterLog::add($certificacion);
		return redirect('admin/certificacion/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$certificacion = CrmCertificacion::FindOrFail($id);
		$certificacion->delete();

		\App\Util\RegisterLog::add($certificacion);
		return redirect('admin/certificacion/');
	}
}
