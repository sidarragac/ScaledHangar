<?php

use Illuminate\Support\Facades\Route;

$adminCategoryControllerRoute = 'App\Http\Controllers\admin\AdminCategoryController@';

//Admin Category Routes

Route::get('/admin/categories', $adminCategoryControllerRoute . 'index')->name('admin.categories.index');
Route::get('/admin/categories/create', $adminCategoryControllerRoute . 'create')->name('admin.categories.create');
Route::post('/admin/categories/save', $adminCategoryControllerRoute . 'save')->name('admin.categories.save');
Route::get('/admin/categories/edit/{id}', $adminCategoryControllerRoute . 'edit')->name('admin.categories.edit');
Route::put('/admin/categories/update/{id}', $adminCategoryControllerRoute . 'update')->name('admin.categories.update');
Route::delete('/admin/categories/delete/{id}', $adminCategoryControllerRoute . 'delete')->name('admin.categories.delete');
