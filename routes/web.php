<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'admin' , 'middleware' => ['role:admin']], function(){
	# Rutas por get
	Route::get('new_enterprise',['as' => 'admin.new_enterprise', 'uses' => 'EnterpriseController@newEnterprise']);
	Route::get('edit_enterprise', ['as' => 'admin.edit_enterprise', 'uses' => 'EnterpriseController@editEnterprise']);	
	
	Route::get('new_client', ['as' => 'admin.new_client', 'uses' => 'ClientController@newClient']);
	Route::get('edit_client', ['as' => 'admin.edit_new_client', 'uses' => 'ClientController@editClient']);

	Route::get('new_credit', ['as' => 'admin.new_credit', 'uses' => 'PlanQuoteController@newCredit']);

	# Rutas por post
	Route::post('create_enterprise', ['as' => 'admin.create_enterprise', 'uses' => 'EnterpriseController@createEnterprise']);
	Route::post('update_enterprise', ['as' => 'admin.update_enterprise', 'uses' => 'EnterpriseController@updateEnterprise']);

	Route::post('create_client', ['as' => 'admin.create_client', 'uses' => 'ClientController@createClient']);
	Route::post('update_client', ['as' => 'admin.update_client', 'uses' => 'ClientController@update_client']);

	Route::post('create_credit', ['as' => 'admin.create_credit', 'uses' => 'PlanQuoteController@createCredit']);

	# Para consultar cliente por rut para el select2
	Route::post('get_client_by_rut', ['as' => 'admin.get_client_by_rut', 'uses' => 'ClientController@getClientByRut']);
});
