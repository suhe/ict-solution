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

Route::group(['prefix' => 'account-bank','middleware'=>['is_logged']], function () {
    Route::get('/', ['uses' => 'Backend\AccountBankController@index','middleware' => ['role_read:account-bank']]);
	Route::get('/view/{slug}', ['uses' => 'Backend\AccountBankController@view','middleware' => ['role_read:account-bank']]);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\AccountBankController@do_publish','middleware' => ['role_update:account-bank']]);
	Route::get('/form', ['uses' => 'Backend\AccountBankController@form','middleware' => ['role_create:account-bank']]);
	Route::get('/form/{slug}', ['uses' => 'Backend\AccountBankController@form','middleware' => ['role_update:account-bank']]);
	Route::post('/do-update', ['uses' => 'Backend\AccountBankController@do_update','middleware' => ['role_update:account-bank']]);
	Route::post('/do-delete', ['uses' => 'Backend\AccountBankController@do_delete','middleware' => ['role_delete:account-bank']]);
});
