<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;

use App\Models\AdmLog;

use Maatwebsite\Excel\Facades\Excel;
use View;

class LogController extends AdminController {

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

		$logs=AdmLog::select()
			->where('created_at', '>=', $sdate)
			->where('created_at', '<', date('Y-m-d', strtotime($edate.' +1 days')))
			->whereHas('user', 
				function ($query) use($filter){
					$query->where('name', 'LIKE', '%'.strtolower($filter).'%');
			    })
			->orderBy('created_at', 'desc');

		if(Request::has('export')){
			$rows = $logs->get();
			$head = ['#ID', 'Usuario', 'Módulo', 'Comentario', 'Fecha Creación', 'Fecha Actualización'];

			$data = [];
			foreach ($rows as $log) {
				$user = $log->user;
				$module = $log->event->module;
				$data[] = [$log->id, $user->name, $module->name, $log->comment, $log->created_at, $log->updated_at];
			}

			//Export spreadsheet document
			return exportExcel($head, $data, 'Logs_'.date('dmY'));
		}

		View::share('filter', $filter);
		View::share('sdate', $sdate);
		View::share('edate', $edate);
        
        return view('admin.log.index', array('logs'=>$logs->Paginate()));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$log = AdmLog::FindOrFail($id);

        return view('admin.log.show', compact('log'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$log = AdmLog::FindOrFail($id);
		$log->delete();

		return redirect('admin/log/');
	}

}
