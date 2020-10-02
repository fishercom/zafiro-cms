<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;

use App\Local;
use App\User;

use DB;
use View;
use Auth;

class LocalController extends Controller
{
	
	public function markers($district_id, Request $request)
	{
		$action = $request->action;
		$list = Local::where('district_id', $district_id)->get();
		$markers = [];
		foreach($list as $item){
			$title = $item->company->name;
			$image = get_local_photo($item);
			$description = $item->address;
			$url = url_company($item);
			$link = $action=='cart'? 'javascript:setlocal('.$item->id.')': $url;

			$markers[] = [
				"title" => $title,
				"lat" => $item->latitude,
				"lng" => $item->longitude,
				"description" => trim('
					<div id="gmarker_'.$item->id.'" url="'.$url.'">
						<h5 class="head">'.$title.'</h5>
						<p class="desc">'.$description.'
						<div align="center"><a href="'.$link.'" class="btn btn-warning">SELECCIONAR</a></div>
						<img src="'.$image.'">
						</p>
				    </div>')
			];
		}

		return response()->json($markers);
	}

}
