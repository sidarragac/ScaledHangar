<?php

namespace App\Http\Controllers;

use App\Interfaces\WeatherProviderInterface;
use App\Models\Product;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $weatherProviderType = $request->input('weatherProvider', 'static');
        $weatherProvider = app()->makeWith(WeatherProviderInterface::class, ['provider' => $weatherProviderType]);
        $viewData = [];
        $viewData['temperature'] = $weatherProvider->getActualWeather();
        $viewData['mostSoldProducts'] = Product::getMostSoldProducts();

        return view('home.index')->with('viewData', $viewData);
    }

    public function changeLocale(Request $request): RedirectResponse
    {
        $current = session('locale', 'en');
        $new = $current === 'es' ? 'en' : 'es';
        Log::info("Changing locale from {$current} to {$new}");
        Session::put('locale', $new); // Store the new locale in the session
        App::setLocale($new);
        config(['app.locale' => $new]); // Update the app locale configuration

        return redirect()->back();
    }
}
