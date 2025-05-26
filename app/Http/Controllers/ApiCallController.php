<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

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
