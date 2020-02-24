<?php

Route::group(['namespace' => 'Demo\Ecommerce\Http\Controllers', 'middleware' => 'web'], function () {

    //Front
    Route::name('font')->namespace('Front')->group(function () {
        Route::get('/', ['as' => '.index', 'uses' => 'ProductController@index']);

        Route::prefix('product')->name('.product')->group(function (){
            Route::get('/', ['as' => '.index', 'uses' => 'ProductController@index']);
        });
        Route::prefix('category')->name('.category')->group(function (){
            Route::get('/', ['as' => '.index', 'uses' => 'CategoryController@index']);

        });
    });

    //Admin
    Route::prefix('admin')->name('admin')->namespace('Admin')->group(function () {
        Route::prefix('product')->name('.product')->group(function (){
            Route::get('/', ['as' => '.index', 'uses' => 'ProductController@index']);
            Route::match(['GET', 'POST'], 'create', ['as' => '.create', 'uses' => 'ProductController@create']);
            Route::post('bulkedit', ['as' => '.bulkedit', 'uses' => 'ProductController@bulkedit']);
        });
        Route::prefix('category')->name('.category')->group(function (){
            Route::match(['GET', 'POST'], '/', ['as' => '.index', 'uses' => 'CategoryController@index']);
            Route::post('bulkedit', ['as' => '.bulkedit', 'uses' => 'CategoryController@bulkedit']);
        });
    });
});
