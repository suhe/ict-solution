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

Route::group(['prefix' => 'customer-group','middleware'=>['is_logged']], function () {
	Route::get('/', ['uses' => 'Backend\CustomerGroupController@index','middleware' => ['role_read:customer-group']]);
	Route::get('/view/{slug}', ['uses' => 'Backend\CustomerGroupController@view','middleware' => ['role_read:customer-group']]);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\CustomerGroupController@do_publish','middleware' => ['role_update:customer-group']]);
	Route::get('/form', ['uses' => 'Backend\CustomerGroupController@form','middleware' => ['role_create:customer-group']]);
	Route::get('/form/{slug}', ['uses' => 'Backend\CustomerGroupController@form','middleware' => ['role_update:customer-group']]);
	Route::post('/do-update', ['uses' => 'Backend\CustomerGroupController@do_update','middleware' => ['role_update:customer-group']]);
	Route::post('/do-delete', ['uses' => 'Backend\CustomerGroupController@do_delete','middleware' => ['role_delete:customer-group']]);
	Route::get('/lists', ['uses' => 'Backend\CustomerGroupController@lists']);
});
