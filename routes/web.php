<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);
Auth::routes();

Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){

    Route::get('login',['uses' => 'LoginController@showLoginForm'])->name('admin.login');
    Route::post('login',['uses' => 'LoginController@login']);
    Route::post('logout',['uses' => 'LoginController@logout']);
    Route::get('/',['middleware' => ['auth:admin', 'admin'], 'uses' => 'HomeController@index'])->name('admin.home');

    Route::group(['middleware' => ['auth:admin', 'admin']], function(){

		Route::resource('user', 'UserController');
		Route::resource('article', 'ArticleController');
		Route::resource('profile', 'ProfileController');
		Route::resource('log', 'LogController');
		Route::resource('lang', 'LangController');
		Route::resource('translate', 'TranslateController');
		Route::resource('config', 'ConfigController');
		Route::resource('site', 'SiteController');
		Route::resource('schema', 'SchemaController');
		Route::resource('directory', 'DirectoryController');
		Route::resource('register', 'RegisterController');
		Route::resource('notify', 'NotifyController');
		Route::resource('parameter', 'ParameterController');

		Route::get('/',['uses' => 'HomeController@index']);
		Route::get('home/notfound',['uses' => 'HomeController@notfound']);
		Route::get('home/permission',['uses' => 'HomeController@permission']);

		Route::post('article/sort', 'ArticleController@sort');
		Route::post('schema/sort', 'SchemaController@sort');
		Route::post('parameter/sort', 'ParameterController@sort');

		Route::get('config/google_oauth/login', 'ConfigController@google_oauth');
		Route::get('config/google_oauth/callback', 'ConfigController@google_oauth_callback');
		Route::post('config/google_oauth/test', ['as' => 'config.test_mail', 'uses'=>'ConfigController@google_oauth_test']);

	});
});

Route::get('/',['uses' => 'FrontController@index']);
Route::get('/{iso}',['uses' => 'FrontController@home'])->where('iso', 'es|en|de|fr');
Route::get('/{slug}', ['uses' => 'FrontController@page']);

//Route::post('payment_response', ['uses' => 'PaymentController@payment_response']);
Route::post('front/login', 'FrontController@post_login');
Route::post('front/logout', 'FrontController@post_logout');
//Route::post('cart/add/{product_id}', 'CartController@store');
//Route::post('cart/update', 'CartController@update');
