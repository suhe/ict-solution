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

Route::group(['prefix' => 'profile','middleware'=>['is_logged']], function () {
    Route::get('/', ['uses' => 'Backend\ProfileController@index']);
	Route::post('/do-update', ['uses' => 'Backend\profileController@do_update']);
	Route::post('/password/do-update', ['uses' => 'Backend\profileController@do_update_password']);
});
