<?php

namespace App\Http\Controllers;

use App\Interfaces\WeatherProviderInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct()
    {

        App::setLocale('en');
    }

    public function index(Request $request): View
    {
        $weatherProviderType = $request->input('weatherProvider', 'static');
        $weatherProvider = app()->makeWith(WeatherProviderInterface::class, ['provider' => $weatherProviderType]);
        $viewData = [];
        $viewData['temperature'] = $weatherProvider->getActualWeather();
        $viewData['mostSoldProducts'] = Product::getMostSoldProducts();
        return view('home.index')->with('viewData', $viewData);

    }
}
