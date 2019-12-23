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

Route::group(['namespace' => 'Products', 'prefix' => 'products'], function () {
    Route::get('/', 'ProductsController@index')->name('products.index');
    Route::get('/{product}', 'ProductsController@show')->name('products.show');
});
