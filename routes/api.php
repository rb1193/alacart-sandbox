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
    Route::get('/{product_sku}', 'ProductsController@show')->name('api.products.show');
    Route::delete('/{product_sku}', 'ProductsController@delete')->name('api.products.delete');

    Route::group(['prefix' => '{product_sku}/translations'], function () {
        Route::get('/', 'ProductTranslationsController@index')->name('api.product-translations.index');
        Route::post('/{locale}', 'ProductTranslationsController@store')->name('api.product-translations.store');
        Route::get('/{locale}', 'ProductTranslationsController@show')->name('api.product-translations.show');
        Route::delete('/{locale}', 'ProductTranslationsController@delete')->name('api.product-translations.delete');
    });
});
