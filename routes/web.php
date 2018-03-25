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

Auth::routes();

Route::get ('/', 'HomeController@home');
Route::post('/registrar', 'HomeController@registrar');
Route::get ('/lista/{municipio}/{hora}', 'HomeController@listar');

Route::group(['middleware' => ['auth']], function() {
	Route::get ('/admin',  'AdminController@index' )->name('admin');
	Route::get ('/crear',  'AdminController@show'  );
	Route::post('/crear',  'AdminController@crear' );
	Route::get ('/editar/{id}', 'AdminController@mostrar');
	Route::post('/editar/{id}', 'AdminController@editar'  );
	Route::get ('/borrar/{id}', 'AdminController@borrar');
});