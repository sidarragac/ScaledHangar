<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use App\Services\ExternalApiService;

class ApiCallController extends Controller
{
    protected $externalApiService;

    public function __construct(ExternalApiService $externalApiService)
    {
        $this->externalApiService = $externalApiService;
    }

    public function showProductsFromApi(): View
    {
        $products = $this->externalApiService->getProducts();
        $viewData = [];
        $viewData['products'] = $products;
        return view('apiCall.index')->with('viewData', $viewData);
    }
}
