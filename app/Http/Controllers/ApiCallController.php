<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class ApiCallController extends Controller
{
    public function showProductsFromApi(): View
    {
        $response = Http::get('http://medallobike.shop/api/products');
        $products = $response->json()['data'];
        $viewData = [];
        $viewData['products'] = $products;
        return view('apiCall.index')->with('viewData', $viewData);
    }
}
