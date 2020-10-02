<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;

use App\AdmLog;

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
			return Excel::create('Logs_'.date('dmY'), function($excel) use($logs){
			    $excel->sheet('Lista', function($sheet) use($logs){
			        // Sheet manipulation
					$sheet->fromArray($logs->get()->toArray());
					//$sheet->rows($registers->get()->toArray());
			    });
			})->export('xls');
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
