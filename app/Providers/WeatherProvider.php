<?php

namespace App\Providers;

use App\Interfaces\WeatherProviderInterface;
use Illuminate\Support\ServiceProvider;
use App\Util\ApiWeather;
use App\Util\StaticWeather;

class WeatherProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(WeatherProviderInterface::class, function ($app, $params) {
            $weatherProvider = $params['provider'] ?? 'static';
            if($weatherProvider === 'static') {
                return new StaticWeather;
            } elseif ($weatherProvider === 'api') {
                return new ApiWeather;
            }
        });
    }
}
