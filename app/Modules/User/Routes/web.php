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
    Route::get('/', ['uses' => 'Backend\UserController@index','middleware' => ['role_read:user']]);
	Route::get('/view/{slug}', ['uses' => 'Backend\UserController@view','middleware' => ['role_read:user']]);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\UserController@do_publish','middleware' => ['role_update:user']]);
	Route::get('/form', ['uses' => 'Backend\UserController@form','middleware' => ['role_create:user']]);
	Route::get('/form/{slug}', ['uses' => 'Backend\UserController@form','middleware' => ['role_update:user']]);
	Route::post('/do-update', ['uses' => 'Backend\UserController@do_update','middleware' => ['role_update:user']]);
	Route::post('/do-delete', ['uses' => 'Backend\UserController@do_delete','middleware' => ['role_delete:user']]);
	Route::get('/reset-password/{slug}', ['uses' => 'Backend\UserController@reset_password','middleware' => ['role_update:user']]);
	Route::post('/do-reset-password', ['uses' => 'Backend\UserController@do_reset_password','middleware' => ['role_update:user']]);
	Route::get('/profile/do-update', ['uses' => 'Backend\ProfileController@do_update']);
});
