<?php
/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
 */

Route::prefix('auth')->group(function($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::group(['middleware' => ['jwt.auth']], function() {

    Route::prefix('auth')->group(function($router) {
        Route::get('user', 'AuthController@user');
    });

    Route::prefix('products')->group(function($router) {
        Route::get('/', 'ProductsController@index');

        Route::get('/{product}', 'ProductsController@show');
        Route::put('/{product}', 'ProductsController@update');

        Route::post('/', 'ProductsController@store');


        Route::delete('/{product}', 'ProductsController@delete');
    });
    
    Route::prefix('categories')->group(function($router) {
        Route::get('/', 'CategoryController@index');

        Route::get('/{category}', 'CategoryController@show');
        Route::put('/{category}', 'CategoryController@update');

        Route::post('/', 'CategoryController@store');


        Route::delete('/{category}', 'CategoryController@delete');
    });

    Route::get('logout', 'AuthController@logout');
});
