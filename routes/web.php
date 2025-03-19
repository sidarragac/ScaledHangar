<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
$orderControllerRoute = 'App\Http\Controllers\OrderController@';


Route::get('/', function () {
    return view('welcome');
});
Route::get('/orders', $orderControllerRoute.'index')->name('orders.index');
Route::get('/orders/{id}', $orderControllerRoute.'show')->name('orders.show');
Route::get('/orders/{id}/invoice', $orderControllerRoute.'invoice')->name('orders.invoice');