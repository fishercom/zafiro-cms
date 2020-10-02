<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;

use App\UbgDepartment;
use App\UbgProvince;
use App\UbgDistrict;
use App\User;

use DB;
use View;
use Auth;

class UbigeoController extends Controller
{
	
	public function department_list(Request $request)
	{
		$list = UbgDepartment::pluck('name', 'id');

		return response()->json($list);
	}

	public function province_list($department_id, Request $request)
	{
		$list = UbgProvince::where('department_id', $department_id)->pluck('name', 'id');

		return response()->json($list);
	}

	public function district_list($department_id, $province_id, Request $request)
	{
		$list = UbgDistrict::where('department_id', $department_id)->where('province_id', $province_id)->pluck('name', 'id');

		return response()->json($list);
	}

	public function save_cookie(Request $request){

		$district = \App\UbgDistrict::find($request->district_id);
		if($district){

		    setcookie("ubigeo", $district->id, time()+ (86400*30),'/');

			return true;
		}
	}

}
