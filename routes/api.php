<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Products', 'prefix' => 'products'], function () {
    Route::get('/', 'ProductsController@index')->name('api.products.index');
    Route::post('/', 'ProductsController@store')->name('api.products.store');
    Route::get('/{product}', 'ProductsController@show')->name('api.products.show');
});
