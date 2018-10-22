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
Route::post('/change/password', 'Auth\ChangePasswordController@renew_password')->name('password.change');
//--------------------------------------------------------------------------------

Route::group(['prefix' => 'home', 'as' => 'home.', 'middleware' => ['auth', 'isEmail']], function (){
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/verification', 'KycController@index')->name('kyc');
    Route::post('/verification', 'KycController@store')->name('kyc.store');
    Route::get('/tokens/buy', 'TokensController@index')->name('tokens');
    Route::post('/tokens/buy', 'TokensController@store_wallet')->name('tokens.store');
    Route::get('/tokens/get/wallets', 'TokensController@current_wallets')->name('current_wallets');
    Route::get('/description_view/{currency}', 'TokensController@description_view')->name('description_view');
    Route::get('/referrals', 'ReferralController@index')->name('referral');
    Route::post('/settings/avatar/upload', 'SettingsController@uploadAvatar')->name('settings.upload.avatar');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function (){
   Route::get('/verification', 'Admin\KycController@index')->name('kyc');
   Route::get('/verification/{investor}/confirm', 'Admin\KycController@confirm')->name('kyc.confirm');
   Route::get('/verification/{investor}/reject', 'Admin\KycController@rejected')->name('kyc.reject');
   Route::get('/history', 'Admin\HistoryController@index')->name('history');
});

Route::get('/storage/{path}', 'SettingsController@getAvatar')->name('settings.get.avatar');
Route::get('settings', 'HomeController@settings')->name('home.settings');

Route::post('admin/test', 'Admin\KycController@users');