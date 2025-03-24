<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class AdminHomeController extends Controller
{
    public function index(): View
    {
        Log::info('Returning the view');
        return view('layouts.admin');
    }
}
