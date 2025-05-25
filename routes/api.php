<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$productApiControllerRoute = 'App\Http\Controllers\Api\ProductApiController@';

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', $productApiControllerRoute.'index')->name('api.product.index');
Route::get('/products/{id}', $productApiControllerRoute.'show')->name('api.product.show');
Route::get('/products/stock', $productApiControllerRoute.'getProductsWithStock')->name('api.product.getProductsWithStock');
