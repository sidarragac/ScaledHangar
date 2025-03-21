<?php

use Illuminate\Support\Facades\Route;

// Controladores
$orderController = 'App\Http\Controllers\OrderController@';
$adminOrderController = 'App\Http\Controllers\Admin\OrderController@';

Route::get('/', function () {
    return view('welcome');
});

// Rutas para usuarios regulares (protegidas por autenticación)
Route::middleware(['auth'])->group(function () use ($orderController) {
    Route::prefix('orders')->group(function () use ($orderController) {
        Route::get('/', $orderController.'index')->name('orders.index');
        Route::get('/{id}', $orderController.'show')->name('orders.show');
        Route::get('/{id}/invoice', $orderController.'invoice')->name('orders.invoice');
    });
}); // Added semicolon here

// Rutas para administradores
Route::middleware(['auth', 'admin'])->prefix('admin/orders')->name('admin.orders.')->group(function () use ($adminOrderController) {
    Route::get('/', $adminOrderController.'index')->name('index');
    Route::get('/create', $adminOrderController.'create')->name('create');
    Route::post('/store', $adminOrderController.'store')->name('store');
    Route::get('/{id}', $adminOrderController.'show')->name('show');
    Route::get('/{id}/edit', $adminOrderController.'edit')->name('edit');
    Route::put('/{id}', $adminOrderController.'update')->name('update');
    Route::delete('/{id}', $adminOrderController.'destroy')->name('destroy');
});