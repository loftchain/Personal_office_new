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
})->name('root')->middleware('guest');

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

Auth::routes();

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
Route::post('/change/password', 'Auth\ChangePasswordController@renew_password')->name('password.change');
Route::post('/set/password', 'Auth\ChangePasswordController@setPassword')->name('password.set');
//--------------------------------------------------------------------------------

Route::any('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'home', 'as' => 'home.', 'middleware' => ['auth', 'isEmail', 'isNotAdmin']], function (){
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/verification', 'KycController@index')->name('kyc');
    Route::post('/verification', 'KycController@store')->name('kyc.store');
    Route::post('/verification/upload', 'KycController@upload')->name('kyc.upload');
    Route::get('/tokens/buy', 'TokensController@index')->name('tokens');
    Route::post('/tokens/buy', 'TokensController@store_wallet')->name('tokens.store');
    Route::get('/tokens/get/wallets', 'TokensController@current_wallets')->name('current_wallets');
    Route::get('/description_view/{currency}', 'TokensController@description_view')->name('description_view');
    Route::get('/referrals', 'ReferralController@index')->name('referral');
    Route::post('/settings/avatar/upload', 'SettingsController@uploadAvatar')->name('settings.upload.avatar');
//    Route::post('/paypal', 'PaymentController@createPayment')->name('paypal');
//    Route::post('/paypal/execute', 'PaymentController@executePayment')->name('paypal.execute');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function (){
   Route::get('/verification', 'Admin\KycController@index')->name('kyc');
   Route::get('/verification/get', 'Admin\KycController@get')->name('kyc.get');
   Route::post('/verification/{investor}/confirm', 'Admin\KycController@confirm')->name('kyc.confirm');
   Route::post('/verification/{investor}/reject', 'Admin\KycController@rejected')->name('kyc.reject');
   Route::get('/history', 'Admin\HistoryController@index')->name('history');
   Route::get('/history/get', 'Admin\HistoryController@get')->name('history.get');
   Route::get('/referral', 'Admin\ReferralController@index')->name('referral');
   Route::get('/referral/get', 'Admin\ReferralController@get')->name('referral.get');
   Route::post('/referral/update', 'Admin\ReferralController@update')->name('referral.update');
   Route::get('/transaction', 'Admin\TransactionController@index')->name('transaction');
   Route::get('/transaction/get', 'Admin\TransactionController@get')->name('transaction.get');
   Route::post('/transaction/update', 'Admin\TransactionController@updateSend')->name('transaction.update');
});

Route::get('/storage/{path}', 'SettingsController@getAvatar')->name('settings.get.avatar');
Route::get('settings', 'HomeController@settings')->name('home.settings')->middleware('isNotAdmin');