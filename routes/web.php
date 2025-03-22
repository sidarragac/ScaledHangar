<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

$homeControllerRoute="App\Http\Controllers\HomeController";

    
Route::get('/', [$homeControllerRoute,'index'])-> name('home.index');

Auth::routes();

