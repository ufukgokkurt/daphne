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


/** Backend */
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function() {

    Route::group(['middleware' => 'visitor'], function () {
        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@postLogin');
        Route::get('forgot-password', 'ForgotPasswordController@getForgot')->name('admin.forgot');
        Route::post('forgot-password', 'ForgotPasswordController@postForgot');
        Route::get('reset/{email}/{resetCode}', 'ForgotPasswordController@resetPassword')->name('admin.reset');
        Route::post('reset/{email}/{resetCode}', 'ForgotPasswordController@postResetPassword');
    });


    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', 'HomeController@home')->name('admin.home');
        Route::post('logout', 'LoginController@logout')->name('admin.logout');


    });


    //Roller ve Kullanıcı ayarları
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');
    Route::get('user/{user}/activate', 'UserController@activate')->name('user.activate');
    Route::get('user/{user}/deactivate', 'UserController@deactivate')->name('user.deactivate');
    Route::post('user/ajax_all', 'UserController@ajax_all')->name('user.ajax');

    //Kullanıcı profili
    Route::get('user-profile', 'UserProfileController@getProfile')->name('user.profile');
    Route::post('user-profile', 'UserProfileController@postProfile');

    //Mail ayarları
    Route::get('smtp-setting', 'SettingController@getSmtp')->name('setting.smtp');
    Route::post('smtp-setting', 'SettingController@postSmtp');
    // Genel ayarlar
    Route::get('general-setting', 'SettingController@getGeneral')->name('setting.general');
    Route::post('general-setting', 'SettingController@postGeneral');


});