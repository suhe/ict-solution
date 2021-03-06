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

Route::group(['prefix' => 'telephone-billing','middleware'=>['is_logged']], function () {
    Route::get('/', ['uses' => 'Backend\TelephoneBillingController@index','middleware' => ['role_read:telephone-billing']]);
	Route::get('/view/{slug}', ['uses' => 'Backend\TelephoneBillingController@view','middleware' => ['role_read:telephone-billing']]);
	Route::get('/do-publish/{slug}', ['uses' => 'Backend\TelephoneBillingController@do_publish','middleware' => ['role_update:telephone-billing']]);
	Route::get('/form', ['uses' => 'Backend\TelephoneBillingController@form','middleware' => ['role_create:telephone-billing']]);
	Route::get('/form/{slug}', ['uses' => 'Backend\TelephoneBillingController@form','middleware' => ['role_update:telephone-billing']]);
	Route::post('/do-update', ['uses' => 'Backend\TelephoneBillingController@do_update','middleware' => ['role_update:telephone-billing']]);
	Route::post('/do-delete', ['uses' => 'Backend\TelephoneBillingController@do_delete','middleware' => ['role_delete:telephone-billing']]);
	Route::post('/do-update/line', ['uses' => 'Backend\TelephoneBillingController@do_update_line','middleware' => ['role_update:telephone-billing']]);
	Route::post('/view-line', ['uses' => 'Backend\TelephoneBillingController@view_line','middleware' => ['role_read:telephone-billing']]);
	Route::post('/do-delete/line', ['uses' => 'Backend\TelephoneBillingController@do_delete_line','middleware' => ['role_delete:telephone-billing']]);
    Route::get('/get/customer', ['uses' => 'Backend\TelephoneBillingController@get_customer']);
    Route::get('/export/pdf/invoice/{slug}', ['uses' => 'Backend\TelephoneBillingPDFController@billing_invoice']);
    Route::get('/export/pdf/statement/{slug}', ['uses' => 'Backend\TelephoneBillingPDFController@billing_statement']);
    Route::post('/do-update/payment', ['uses' => 'Backend\TelephoneBillingController@do_update_payment','middleware' => ['role_update:telephone-billing']]);
    Route::post('/do-delete/payment', ['uses' => 'Backend\TelephoneBillingController@do_delete_payment','middleware' => ['role_delete:telephone-billing']]);
    Route::get('/export/pdf/payment-receipt/{slug}', ['uses' => 'Backend\TelephoneBillingPDFController@payment_receipt']);
    Route::get('/report', ['uses' => 'Backend\TelephoneBillingController@report']);
    Route::get('/report/billing-details', ['uses' => 'Backend\TelephoneBillingController@report_billing_details']);
    Route::get('/export/excel/billing-details', ['uses' => 'Backend\TelephoneBillingExcelController@billing_details','middleware' => ['role_create:telephone-billing']]);
});
