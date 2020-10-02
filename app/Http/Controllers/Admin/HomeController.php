<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;

use View;
use Auth;

class HomeController extends AdminController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
    public function __construct()
    {

        View::share('current_module', \App\AdmModule::select()->where('controller', 'home')->first());
    }

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user=Auth::user();
		$profile=$user->profile;
		$menu_list = \App\AdmMenu::select()->where('parent_id', null)->where('active', '1')->get();

		if($profile->id!=1){
		    $user_module=\App\AdmModule::select(['id', 'menu_id'])
		        ->whereIn('id', \App\AdmEvent::select()
		            ->whereIn('id', \App\AdmPermission::select()
		                ->where('profile_id', $profile->id)
		                ->pluck('event_id')
		            )
		            ->pluck('module_id')
		        )
		        ->where('active', '1');
		}
		else{
		    $user_module=\App\AdmModule::select()
		        ->where('active', '1');
		}

		return view('admin.home.index', compact('user_module', 'menu_list'));
	}

	public function notfound()
	{
		return view('admin.home.notfound');
	}
	public function permission()
	{
		return view('admin.home.permission');
	}

}
