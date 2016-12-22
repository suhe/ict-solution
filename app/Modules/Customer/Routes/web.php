<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'customer','middleware'=>['is_logged']], function () {
    Route::get('/', ['uses' => 'Backend\CustomerController@index','middleware' => ['role_read:customer']]);
	Route::get('/view/{slug}', ['uses' => 'Backend\CustomerController@view','middleware' => ['role_read:customer']]);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\CustomerController@do_publish','middleware' => ['role_update:customer']]);
	Route::get('/form', ['uses' => 'Backend\CustomerController@form','middleware' => ['role_create:customer']]);
	Route::get('/form/{slug}', ['uses' => 'Backend\CustomerController@form','middleware' => ['role_update:customer']]);
	Route::get('/get/city', ['uses' => 'Backend\CustomerController@get_city']);
	Route::get('/get/customer-group', ['uses' => 'Backend\CustomerController@get_customer_group']);
	Route::post('/do-update', ['uses' => 'Backend\CustomerController@do_update','middleware' => ['role_update:customer']]);
	Route::post('/do-delete', ['uses' => 'Backend\CustomerController@do_delete','middleware' => ['role_delete:customer']]);
});
