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

        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, "es_PE");

    }

}
