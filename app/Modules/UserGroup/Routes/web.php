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

Route::group(['prefix' => 'user-group','middleware'=>['is_logged']], function () {
    Route::get('/', ['uses' => 'Backend\UserGroupController@index','middleware' => ['role_read:user-group']]);
	Route::get('/view/{slug}', ['uses' => 'Backend\UserGroupController@view','middleware' => ['role_read:user-group']]);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\UserGroupController@do_publish','middleware' => ['role_update:user-group']]);
	Route::get('/form', ['uses' => 'Backend\UserGroupController@form','middleware' => ['role_create:user-group']]);
	Route::get('/form/{slug}', ['uses' => 'Backend\UserGroupController@form','middleware' => ['role_update:user-group']]);
	Route::post('/do-update', ['uses' => 'Backend\UserGroupController@do_update','middleware' => ['role_update:user-group']]);
	Route::post('/do-delete', ['uses' => 'Backend\UserGroupController@do_delete','middleware' => ['role_delete:user-group']]);
});
