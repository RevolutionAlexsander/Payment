<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/applications/add', 'application');
Route::get('/applications/add', 'ApiControllers\ApplicationController@Application');
Route::get('/payments', 'ApiControllers\PaymentController@Payment');
Route::get('/payments/add', 'ApiControllers\PaymentController@Add');
Route::get('/autopayments', 'ApiControllers\AutoPaymentController@AutoPayment');
Route::get('/autopayments/add', 'ApiControllers\AutoPaymentController@addAuto');

