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
    Route::get('/', ['uses' => 'Backend\CustomerController@index']);
	Route::get('/view/{slug}', ['uses' => 'Backend\CustomerController@view']);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\CustomerController@do_publish']);
	Route::get('/form', ['uses' => 'Backend\CustomerController@form']);
	Route::get('/form/{slug}', ['uses' => 'Backend\CustomerController@form']);
	Route::get('/get/city', ['uses' => 'Backend\CustomerController@get_city']);
	Route::get('/get/customer-group', ['uses' => 'Backend\CustomerController@get_customer_group']);
	Route::post('/do-update', ['uses' => 'Backend\CustomerController@do_update']);
	Route::post('/do-delete', ['uses' => 'Backend\CustomerController@do_delete']);
});
