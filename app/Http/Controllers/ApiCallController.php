<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiService;
use Illuminate\View\View;

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
