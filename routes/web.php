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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'social', 'as' => 'social.'], function () {
    Route::get('redirect/{provider}', 'Auth\SocialAuthController@redirect')->name('redirect');
    Route::get('callback/{provider}', 'Auth\SocialAuthController@callback')->name('callback');
});

Route::get('/test', function (){
   return view('test');
});
