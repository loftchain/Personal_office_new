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
    return view('welcome');
})->name('root');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//------------------------Forgot Your password------------------------------------
Route::post('/sendResetLink', 'Auth\ForgotPasswordController@sendResetLinkEmailCustom')->name('sendResetLinkEmail');
//--------------------------------------------------------------------------------

//------------------------Social Auth---------------------------------------------
Route::group(['prefix' => 'social', 'as' => 'social.'], function () {
    Route::get('redirect/{provider}', 'Auth\SocialAuthController@redirect')->name('redirect');
    Route::get('callback/{provider}', 'Auth\SocialAuthController@callback')->name('callback');
});
//--------------------------------------------------------------------------------

//------------------------ChangeEmail/ChangePassword------------------------------
Route::post('/change/email', 'Auth\ChangeEmailController@reset_email')->name('email.reset');
//--------------------------------------------------------------------------------

Route::group(['prefix' => 'home', 'as' => 'home.', 'middleware' => ['auth', 'isEmail']], function (){
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/verification', 'KycController@index')->name('kyc');
    Route::post('/verification', 'KycController@store')->name('kyc.store');
    Route::get('/tokens/buy', 'TokensController@index')->name('tokens');
    Route::post('/tokens/buy', 'TokensController@store_wallet')->name('tokens.store');
    Route::get('/tokens/get/wallets', 'TokensController@current_wallets')->name('current_wallets');
    Route::get('/description_view/{currency}', 'TokensController@description_view')->name('description_view');
});

Route::get('settings', 'HomeController@settings')->name('home.settings');
