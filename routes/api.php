<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', 'Api\AuthController@login');
Route::middleware('auth:api')->post('/logout', 'Api\AuthController@logout');
Route::middleware('auth:api')->post('/user', 'Api\AuthController@user');

Route::get('/parameter/{id}/list',['uses' => 'Api\ParameterController@list']);
Route::get('/parameter/{id}',['uses' => 'Api\ParameterController@info']);

Route::get('/ubigeo/department/list',['uses' => 'Api\UbigeoController@department_list']);
Route::get('/ubigeo/province/{department_id}/list',['uses' => 'Api\UbigeoController@province_list']);
Route::get('/ubigeo/district/{department_id}/{province_id}/list',['uses' => 'Api\UbigeoController@district_list']);
//Route::get('/locales/markers/{district_id}', ['uses' => 'Api\LocalController@markers']);

//Route::post('/ubigeo/save_cookie',['uses' => 'Api\UbigeoController@save_cookie']);

Route::post('/form',['uses' => 'Api\FormController@store']);
