<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

$homeControllerRoute="App\Http\Controllers\HomeController";
$adminDashboardControllerRoute="App\Http\Controllers\Admin\DashboardController";
    
Route::get('/', [$homeControllerRoute,'index'])-> name('home.index');

Route::get('/admin', [$adminDashboardControllerRoute,'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Auth::routes();

