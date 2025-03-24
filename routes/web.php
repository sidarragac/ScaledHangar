<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$adminCategoryControllerRoute = 'App\Http\Controllers\Admin\AdminCategoryController@';
$adminProductControllerRoute = 'App\Http\Controllers\Admin\AdminProductController@';
$productControllerRoute = 'App\Http\Controllers\ProductController@';
$cartControllerRoute = 'App\Http\Controllers\CartController@';

$homeControllerRoute = "App\Http\Controllers\HomeController";
$adminDashboardControllerRoute = "App\Http\Controllers\Admin\DashboardController";

Route::get('/', [$homeControllerRoute, 'index'])->name('home.index');

Route::get('/admin', [$adminDashboardControllerRoute, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Auth::routes();

// Admin Category Routes

Route::get('/admin/categories', $adminCategoryControllerRoute.'index')->name('admin.category.index');
Route::get('/admin/categories/show/{id}', $adminCategoryControllerRoute.'show')->name('admin.category.show');
Route::get('/admin/categories/create', $adminCategoryControllerRoute.'create')->name('admin.category.create');
Route::post('/admin/categories/save', $adminCategoryControllerRoute.'save')->name('admin.category.save');
Route::get('/admin/categories/edit/{id}', $adminCategoryControllerRoute.'edit')->name('admin.category.edit');
Route::put('/admin/categories/update/{id}', $adminCategoryControllerRoute.'update')->name('admin.category.update');
Route::delete('/admin/categories/delete/{id}', $adminCategoryControllerRoute.'delete')->name('admin.category.delete');

// Admin Product Routes
Route::get('/admin/products', $adminProductControllerRoute.'index')->name('admin.product.index');
Route::get('/admin/products/show/{id}', $adminProductControllerRoute.'show')->name('admin.product.show');
Route::get('/admin/products/create', $adminProductControllerRoute.'create')->name('admin.product.create');
Route::post('/admin/products/save', $adminProductControllerRoute.'save')->name('admin.product.save');
Route::get('/admin/products/edit/{id}', $adminProductControllerRoute.'edit')->name('admin.product.edit');
Route::put('/admin/products/update/{id}', $adminProductControllerRoute.'update')->name('admin.product.update');
Route::delete('/admin/products/delete/{id}', $adminProductControllerRoute.'delete')->name('admin.product.delete');

// Product Routes
Route::get('/products', $productControllerRoute.'index')->name('product.index');

// Cart Routes
Route::get('/cart', $cartControllerRoute.'index')->name('cart.index');
Route::get('/cart/add/{id}', $cartControllerRoute.'add')->name('cart.add');
Route::get('/cart/remove/{id}', $cartControllerRoute.'remove')->name('cart.remove');
Route::get('/cart/checkout', $cartControllerRoute.'checkout')->name('cart.checkout'); //Requires the user to be logged in.
Route::get('/cart/clear', $cartControllerRoute.'clear')->name('cart.clear');
