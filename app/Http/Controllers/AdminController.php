<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class AdminController extends Controller {

    public function __construct()
    {
		//Middleware moved to routes config
		//$this->middleware('auth');
		//$this->middleware('admin');

    }

}
