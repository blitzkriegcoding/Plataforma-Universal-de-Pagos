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
	
	# Rutas por get #
	Route::get('/', 							['as' => 'index', 							'uses' 	=> 'HomeController@index']);
	Route::get('new_enterprise',				['as' => 'admin.new_enterprise', 			'uses' 	=> 'EnterpriseController@newEnterprise']);
	Route::get('edit_enterprise', 				['as' => 'admin.edit_enterprise', 			'uses' 	=> 'EnterpriseController@editEnterprise']);
	Route::get('new_client', 					['as' => 'admin.new_client', 				'uses' 	=> 'ClientController@newClient']);
	Route::get('edit_client', 					['as' => 'admin.edit_new_client', 			'uses' 	=> 'ClientController@editClient']);
	Route::get('new_credit', 					['as' => 'admin.new_credit', 				'uses' 	=> 'PlanQuoteController@newCredit']);
	Route::get('massive_upload_credits', 		['as' => 'admin.massive_upload_credits', 	'uses' 	=> 'MassiveCreditLoaderController@newLoad']);
	Route::get('authorize_commit_credits', 		['as' => 'admin.authorize_commit_credits', 	'uses' 	=> 'MassiveCreditLoaderController@presetCommitOrRollBack']);
	Route::get('rollback_upload', 				['as' => 'admin.rollback_upload', 			'uses' 	=> 'MassiveCreditLoaderController@rollBackUpload']);
	Route::get('commit_upload', 				['as' => 'admin.commit_upload', 			'uses' 	=> 'MassiveCreditLoaderController@commitUpload']);	
	Route::get('massive_upload_result', 		['as' => 'admin.massive_upload_result', 	'uses' 	=> 'MassiveCreditLoaderController@resultsLoad']);
	Route::get('uploads_history_report', 		['as' => 'admin.uploads_history_report', 	'uses' 	=> 'MassiveCreditLoaderController@historyReport']);
	Route::get('new_channel', 					['as' => 'admin.new_channel', 				'uses'	=> 'ChannelController@newChannel']);
	Route::get('new_enterprise_channel', 		['as' => 'admin.new_enterprise_channel', 	'uses' 	=> 'EnterpriseChannelController@newAssociation']);
	Route::get('new_daily_interest',			['as' => 'admin.new_daily_interest',		'uses'	=> 'InterestController@newDailyInterest']);
	Route::get('new_monthly_interest',			['as' => 'admin.new_monthly_interest',		'uses'	=> 'InterestController@newMonthlyInterest']);
	Route::get('report_clients', 				['as' => 'admin.report_clients', 			'uses' 	=> 'ClientController@reportClients']);
	Route::get('del_item_from_loaded_lote', 	['as' => 'admin.del_item_from_loaded_lote', 'uses' 	=> 'ClientController@deleteItemFromLoadedLote']);
	Route::get('view_client_quotes', 			['as' => 'admin.view_client_quotes', 		'uses' 	=> 'ClientController@viewClientQuotes']);


	# Rutas por post #
	Route::post('create_enterprise', 			['as' => 'admin.create_enterprise', 		'uses'	=> 'EnterpriseController@createEnterprise']);
	Route::post('update_enterprise', 			['as' => 'admin.update_enterprise', 		'uses'	=> 'EnterpriseController@updateEnterprise']);
	Route::post('create_client', 				['as' => 'admin.create_client', 			'uses'	=> 'ClientController@createClient']);
	Route::post('update_client', 				['as' => 'admin.update_client', 			'uses'	=> 'ClientController@updateClient']);
	Route::post('create_credit', 				['as' => 'admin.create_credit', 			'uses'	=> 'PlanQuoteController@createCredit']);
	Route::post('upload_credits', 				['as' => 'admin.upload_credits', 			'uses'	=> 'MassiveCreditLoaderController@uploadFile']);
	Route::post('create_channel', 				['as' => 'admin.create_channel', 			'uses' 	=> 'ChannelController@createChannel']);
	Route::post('create_enterprise_channel', 	['as' => 'admin.create_enterprise_channel', 'uses' 	=> 'EnterpriseChannelController@createAssociation']);
	Route::post('create_daily_interest', 		['as' => 'admin.create_daily_interest', 	'uses' 	=> 'InterestController@createDailyInterest']);
	Route::post('create_monthly_interest', 		['as' => 'admin.create_monthly_interest', 	'uses' 	=> 'InterestController@createMonthlyInterest']);
	Route::post('update_client_quotes', 		['as' => 'admin.update_client_quotes', 		'uses' 	=> 'QuoteController@updateClientQuotes']);
	

	# Para consultar cliente por rut para el select2
	Route::post('get_client_by_rut', 			['as' => 'admin.get_client_by_rut', 		'uses' => 'ClientController@getClientByRut']);
	# Para consultar empresa por nombre para el select2
	Route::post('get_enterprise_by_name', 		['as' => 'admin.get_enterprise_by_name', 	'uses' => 'EnterpriseController@getEnterpriseByName']);
	# Para consultar canales por numero para el select2
	Route::post('get_channel_by_number', 		['as' => 'admin.get_channel_by_number', 	'uses' => 'ChannelController@getChannelByNumber']);
	# Para consultar los históricos de carga 
	Route::post('get_uploads_history',			['as' => 'admin.get_uploads_history', 		'uses' => 'MassiveCreditLoaderController@getUploadsHistory' ]);
	# Para consultar todos los clientes de la empresa
	Route::post('get_all_clients', 				['as' => 'admin.get_all_clients', 			'uses' => 'ClientController@getAllClients']);
	# Para filtrar los clientes de la empresa
	Route::post('get_filtered_clients', 		['as' => 'admin.get_filtered_clients', 		'uses' => 'ClientController@getFilteredClients']);
	# Para ver la carga actual del lote y modificarla
	Route::post('get_current_loaded_lote', 		['as' => 'admin.get_current_loaded_lote', 	'uses' => 'MassiveCreditLoaderController@getCurrentLoadedLote']);
	# Para filtrar los registros del archivo
	Route::post('get_filtered_loaded_lote', 	['as' => 'admin.get_filtered_loaded_lote', 	'uses' => 'MassiveCreditLoaderController@getFilteredLoadedLote']);
	# Para visualizar las cuotas
	Route::post('get_client_quotes', 			['as' => 'admin.get_client_quotes', 		'uses' => 'QuoteController@getClientQuotes']);


});
