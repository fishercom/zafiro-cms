<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;

use App\Models\CmsArticle;


use DB;
use View;

class ArticleController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Article Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    function children($id){

        $list = CmsArticle::select()
                ->where('active', '1')
                ->where('parent_id', $id)
                ->orderBy('position')
                ->get();

        return response()->json($list);

    }

    function info($id){

        $item = CmsArticle::find($id);

        return response()->json($item);

    }


}
