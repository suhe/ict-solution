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

Route::group(['prefix' => 'user-group'], function () {
    Route::get('/', ['uses' => 'Backend\UserGroupController@index']);
	Route::get('/view/{slug}', ['uses' => 'Backend\UserGroupController@view']);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\UserGroupController@do_publish']);
	Route::get('/form', ['uses' => 'Backend\UserGroupController@form']);
	Route::get('/form/{slug}', ['uses' => 'Backend\UserGroupController@form']);
	Route::post('/do-update', ['uses' => 'Backend\UserGroupController@do_update']);
	Route::post('/do-delete', ['uses' => 'Backend\UserGroupController@do_delete']);
});
