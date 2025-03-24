<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

use Illuminate\View\View;

class HomeController extends Controller
{

    public function __construct() {
        
        App::setLocale('en');
    }
    public function index(): View
    {

        return view('landing.index');

    }
}