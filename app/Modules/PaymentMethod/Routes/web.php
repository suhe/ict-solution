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

Route::group(['prefix' => 'payment-method','middleware'=>['is_logged']], function () {
    Route::get('/', ['uses' => 'Backend\PaymentMethodController@index','middleware' => ['role_read:payment-method']]);
	Route::get('/view/{slug}', ['uses' => 'Backend\PaymentMethodController@view','middleware' => ['role_read:payment-method']]);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\PaymentMethodController@do_publish','middleware' => ['role_update:payment-method']]);
	Route::get('/form', ['uses' => 'Backend\PaymentMethodController@form','middleware' => ['role_create:payment-method']]);
	Route::get('/form/{slug}', ['uses' => 'Backend\PaymentMethodController@form','middleware' => ['role_update:payment-method']]);
	Route::post('/do-update', ['uses' => 'Backend\PaymentMethodController@do_update','middleware' => ['role_update:payment-method']]);
	Route::post('/do-delete', ['uses' => 'Backend\PaymentMethodController@do_delete','middleware' => ['role_delete:payment-method']]);
    Route::get('get/type',['uses' => 'Backend\PaymentMethodController@get_type']);

});
