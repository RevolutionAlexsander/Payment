<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'auth:api'], function () {
    Route::namespace('ApiControllers')->group(function (){
        Route::group(['prefix' => 'accounts'], function () {
            Route::get('/all', 'AccountController@all');
        });
        Route::group(['prefix' => 'applications'], function () {
            Route::get('/', 'ApplicationController@all');
            Route::post('/approval', 'ApplicationController@approvalApplication');
            Route::get('/typeCredit', 'ApplicationController@getCredit');
            Route::get('/typeAccount', 'ApplicationController@getAccount');
            Route::post('/add', 'ApplicationController@addApplication');
        });
        Route::group(['prefix' => 'payment'], function () {
            Route::get('/', 'PaymentController@historyPayment');
            Route::get('/account', 'PaymentController@getAddPayment');
            Route::post('/add', 'PaymentController@addPayment');
        });
        Route::group(['prefix' => 'autopayment'], function () {
            Route::get('/', 'AutoPaymentController@all');
            Route::get('/account', 'AutoPaymentController@getAccount');
            Route::get('/type', 'AutoPaymentController@getType');
            Route::post('/add', 'AutoPaymentController@addAutoPayment');
            Route::post('/frozen', 'AutoPaymentController@frozenAutoPayment');
            Route::post('/noFrozen', 'AutoPaymentController@noFrozenAutoPayment');
        });
    });
});
