<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\LaravelLocalization;


Route::group(
    [
        'prefix' => (new Mcamara\LaravelLocalization\LaravelLocalization)->setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    Route::group(['namespace' => 'Dashboard','middleware'=>'auth:admin','prefix' => 'admin'], function () {

        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::get('logout','LoginController@logout')->name('admin.logout');



        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShipingMethods')
                ->name('edit.shippings.methods');

            Route::put('shipping-methods/{id}','SettingsController@updateShippingMethods')
                ->name('update.shippings.methods');
        });


    });


    Route::group(['namespace' => 'Dashboard', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {


        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@postlogin')->name('admin.post.login');

    });


});



