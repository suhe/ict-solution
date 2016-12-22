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

Route::group(['prefix' => 'user','middleware'=>['is_logged']], function () {
    Route::get('/', ['uses' => 'Backend\UserController@index']);
	Route::get('/view/{slug}', ['uses' => 'Backend\UserController@view']);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\UserController@do_publish']);
	Route::get('/form', ['uses' => 'Backend\UserController@form']);
	Route::get('/form/{slug}', ['uses' => 'Backend\UserController@form']);
	Route::post('/do-update', ['uses' => 'Backend\UserController@do_update']);
	Route::post('/do-delete', ['uses' => 'Backend\UserController@do_delete']);
	Route::get('/reset-password/{slug}', ['uses' => 'Backend\UserController@reset_password']);
	Route::post('/do-reset-password', ['uses' => 'Backend\UserController@do_reset_password']);
});
