<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;

use App\CmsParameter;


use DB;
use View;

class ParameterController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Front Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    function list($id){

        $list = CmsParameter::select('name', 'id')
                ->where('active', '1')
                ->where('parent_id', $id)
                ->orderBy('position')
                ->pluck('name', 'id');

        return response()->json($list);

    }

    function info($id){

        $item = CmsParameter::find($id);
        $info = [
                    'id'=>$item->id,
                    'name'=>$item->name,
                    'color'=>get_field($item->param, 'color'),
                    'definicion'=>get_field($item->param, 'definicion'),
                ];

        return response()->json($info);

    }


}
