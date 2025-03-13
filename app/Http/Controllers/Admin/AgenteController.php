<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AgenteRequest;
use App\Notifications\CertificadoNotification;

use App\Models\CrmPerfilAgente;
use App\Models\CrmAgente;
use App\Models\CmsParameter;
use App\Models\CrmAgenteCertificacion;
use View;

class AgenteController extends AdminController
{
    public function __construct(){
        $tipoagentes = CmsParameter::select()
                        ->whereHas('group', function($query){
                            $query->where('alias', 'tipoagente');
                        })
                        ->pluck('name', 'id');

        $perfiles = CrmPerfilAgente::select()
                        ->orderBy('name')
                        ->pluck('name', 'id');

		View::share('tipoagentes', $tipoagentes);
		View::share('perfiles', $perfiles);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$filter = $request->has('filter')? $request->input('filter'): NULL;

		$agentes = CrmAgente::select()
			->where('name', 'LIKE', '%'.$filter.'%')
			->orderBy('id')
			->Paginate();

		View::share('filter', $filter);

        return view('admin.agente.index', array('agentes'=>$agentes));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$agente=new CrmAgente($request->all());
		$agente->active = '1';

        return view('admin.agente.create', compact('agente'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AgenteRequest $request)
	{
        $certificaciones = $request->get('certificaciones');

        $agente = CrmAgente::Create($request->all());

        if($certificaciones){
            foreach($certificaciones as $certificacion_id){
                CrmAgenteCertificacion::create([
                    'agente_id' => $agente->id,
                    'certificacion_id' => $certificacion_id
                ]);
            }
        }

		\App\Util\RegisterLog::add($agente);
		return redirect('admin/agente/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$agente = CrmAgente::find($id);

        return view('admin.agente.show', compact('agente'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$agente = CrmAgente::FindOrFail($id);

        return view('admin.agente.edit', compact('agente'));
	}

    public function certificacion_create(Request $request){
        $agente_id = $request->agente_id;
		$agentecert = new CrmAgenteCertificacion(['agente_id'=>$agente_id]);

        return view('admin.agente.certificacion.create', compact('agentecert', 'agente_id'));
    }

    public function certificacion_edit($id){
		$agentecert = CrmAgenteCertificacion::FindOrFail($id);

        return view('admin.agente.certificacion.edit', compact('agentecert'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function certificacion_store(Request $request)
	{
        $agentecert = new CrmAgenteCertificacion();
		$agentecert->fill($request->all());
		$agentecert->save();

		//Send mail
		if($request->enviado){
			$this->send_certificado($agentecert);
		}

		\App\Util\RegisterLog::add($agentecert);
		return redirect('admin/agente/'.$agentecert->agente_id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function certificacion_update(Request $request, $id)
	{
		$agentecert = CrmAgenteCertificacion::FindOrFail($id);
		$agentecert->fill($request->all());
		$agentecert->save();

		//Send mail
		if($agentecert->enviado){
			$this->send_certificado($agentecert);
		}

		\App\Util\RegisterLog::add($agentecert);
		return redirect('admin/agente/'.$agentecert->agente_id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(AgenteRequest $request, $id)
	{
        $certificaciones = $request->get('certificaciones');

		$agente = CrmAgente::FindOrFail($id);
		$agente->fill($request->all());
		$agente->active = $request->active;
		$agente->save();

        if($certificaciones){
            CrmAgenteCertificacion::where('agente_id', $id)
                ->delete();
            foreach($certificaciones as $certificacion_id){
                CrmAgenteCertificacion::create([
                    'agente_id' => $id,
                    'certificacion_id' => $certificacion_id
                ]);
            }
        }

		\App\Util\RegisterLog::add($agente);
		return redirect('admin/agente/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$agente = CrmAgente::FindOrFail($id);
		$agente->delete();

		\App\Util\RegisterLog::add($agente);
		return redirect('admin/agente/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function certificacion_delete($id)
	{
		$agentecert = CrmAgenteCertificacion::FindOrFail($id);
		$agentecert->delete();

		\App\Util\RegisterLog::add($agentecert);
		return redirect('admin/agente/');
	}

	private function send_certificado($agentecert){
		$agentecert->agente->notify(new CertificadoNotification($agentecert));
	}

}
