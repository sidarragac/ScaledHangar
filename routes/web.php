<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

$adminCategoryControllerRoute = 'App\Http\Controllers\Admin\AdminCategoryController@';
$adminProductControllerRoute = 'App\Http\Controllers\Admin\AdminProductController@';
$productControllerRoute = 'App\Http\Controllers\ProductController@';

$homeControllerRoute = "App\Http\Controllers\HomeController";

Route::get('/', [$homeControllerRoute,'index'])-> name('home.index');
Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (){
    $adminDashboardControllerRoute = "App\Http\Controllers\Admin\AdminHomeController";
    Route::get('/', [$adminDashboardControllerRoute,'index'])->name('home');
    // Category Routes
    Route::prefix('categories')->name('category.')->group(function (){
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
    Route::prefix('products')->name('product.')->group(function (){
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
