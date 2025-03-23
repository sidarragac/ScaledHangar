<?php

use Illuminate\Support\Facades\Route;

$adminCategoryControllerRoute = 'App\Http\Controllers\admin\AdminCategoryController@';
$adminProductControllerRoute = 'App\Http\Controllers\admin\AdminProductController@';

// Admin Category Routes
Route::get('/admin/categories', $adminCategoryControllerRoute.'index')->name('admin.categories.index');
Route::get('/admin/categories/create', $adminCategoryControllerRoute.'create')->name('admin.categories.create');
Route::post('/admin/categories/save', $adminCategoryControllerRoute.'save')->name('admin.categories.save');
Route::get('/admin/categories/edit/{id}', $adminCategoryControllerRoute.'edit')->name('admin.categories.edit');
Route::put('/admin/categories/update/{id}', $adminCategoryControllerRoute.'update')->name('admin.categories.update');
Route::delete('/admin/categories/delete/{id}', $adminCategoryControllerRoute.'delete')->name('admin.categories.delete');

// Admin Product Routes
Route::get('/admin/products', $adminProductControllerRoute.'index')->name('admin.product.index');
Route::get('/admin/productss/create', $adminProductControllerRoute.'create')->name('admin.product.create');
Route::post('/admin/productss/save', $adminProductControllerRoute.'save')->name('admin.product.save');
Route::get('/admin/products/edit/{id}', $adminProductControllerRoute.'edit')->name('admin.product.edit');
Route::put('/admin/products/update/{id}', $adminProductControllerRoute.'update')->name('admin.product.update');
Route::delete('/admin/products/delete/{id}', $adminProductControllerRoute.'delete')->name('admin.product.delete');
