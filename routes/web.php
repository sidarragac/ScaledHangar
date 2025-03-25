<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$adminCategoryControllerRoute = 'App\Http\Controllers\Admin\AdminCategoryController@';
$adminProductControllerRoute = 'App\Http\Controllers\Admin\AdminProductController@';
$productControllerRoute = 'App\Http\Controllers\ProductController@';
$cartControllerRoute = 'App\Http\Controllers\CartController@';
$wishItemControllerRoute = 'App\Http\Controllers\WishItemController@';

$homeControllerRoute = "App\Http\Controllers\HomeController";

Route::get('/', [$homeControllerRoute, 'index'])->name('home.index');
Auth::routes();
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    $adminHomeControllerRoute = "App\Http\Controllers\Admin\AdminHomeController@";
    Route::get('/', $adminHomeControllerRoute.'index')->name('home');
    // Category Routes
    Route::prefix('categories')->name('category.')->group(function () {
        $adminCategoryControllerRoute = 'App\Http\Controllers\Admin\AdminCategoryController@';
        Route::get('/', $adminCategoryControllerRoute.'index')->name('index');
        Route::get('/show/{id}', $adminCategoryControllerRoute.'show')->name('show');
        Route::get('/create', $adminCategoryControllerRoute.'create')->name('create');
        Route::post('/save', $adminCategoryControllerRoute.'save')->name('save');
        Route::get('/edit/{id}', $adminCategoryControllerRoute.'edit')->name('edit');
        Route::put('/update/{id}', $adminCategoryControllerRoute.'update')->name('update');
        Route::delete('/delete/{id}', $adminCategoryControllerRoute.'delete')->name('delete');

    });
    // Product Routes
    Route::prefix('products')->name('product.')->group(function () {
        $adminProductControllerRoute = 'App\Http\Controllers\Admin\AdminProductController@';
        Route::get('/', $adminProductControllerRoute.'index')->name('index');
        Route::get('/show/{id}', $adminProductControllerRoute.'show')->name('show');
        Route::get('/create', $adminProductControllerRoute.'create')->name('create');
        Route::post('/save', $adminProductControllerRoute.'save')->name('save');
        Route::get('/edit/{id}', $adminProductControllerRoute.'edit')->name('edit');
        Route::put('/update/{id}', $adminProductControllerRoute.'update')->name('update');
        Route::delete('/delete/{id}', $adminProductControllerRoute.'delete')->name('delete');
    });

});
// Product Routes
Route::get('/products', $productControllerRoute.'index')->name('product.index');

// Cart Routes
Route::prefix('cart')->name('cart.')->middleware('auth')->group(function () {
    $cartControllerRoute = 'App\Http\Controllers\CartController@';
    Route::get('/', $cartControllerRoute.'index')->name('index');
    Route::get('/add/{id}', $cartControllerRoute.'add')->name('add');
    Route::get('/remove/{id}', $cartControllerRoute.'remove')->name('remove');
    Route::get('/checkout', $cartControllerRoute.'checkout')->name('checkout'); // Requires the user to be logged in.
    Route::get('/clear', $cartControllerRoute.'clear')->name('clear');
});

// WishItem Routes
Route::prefix('wish_items')->name('wish_items.')->middleware('auth')->group(function () {
    Route::get('/', $wishItemControllerRoute.'index')->name('index');
    Route::get('/add/{id}', $wishItemControllerRoute.'addItem')->name('add');
    Route::delete('/remove/{id}', $wishItemControllerRoute.'removeItem')->name('remove');
});
