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

Route::group(['prefix' => 'bank','middleware'=>['is_logged']], function () {
    Route::get('/', ['uses' => 'Backend\BankController@index','middleware' => ['role_read:bank']]);
	Route::get('/view/{slug}', ['uses' => 'Backend\BankController@view','middleware' => ['role_read:bank']]);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\BankController@do_publish','middleware' => ['role_update:bank']]);
	Route::get('/form', ['uses' => 'Backend\BankController@form','middleware' => ['role_create:bank']]);
	Route::get('/form/{slug}', ['uses' => 'Backend\BankController@form','middleware' => ['role_update:bank']]);
	Route::post('/do-update', ['uses' => 'Backend\BankController@do_update','middleware' => ['role_update:bank']]);
	Route::post('/do-delete', ['uses' => 'Backend\BankController@do_delete','middleware' => ['role_delete:bank']]);
});
