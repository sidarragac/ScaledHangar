<?php

namespace App\Providers;

use App\Interfaces\WeatherProviderInterface;
use App\Util\ApiWeather;
use App\Util\StaticWeather;
use Illuminate\Support\ServiceProvider;

class WeatherProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(WeatherProviderInterface::class, function ($app, $params) {
            $weatherProvider = $params['provider'] ?? 'static';
            if ($weatherProvider === 'static') {
                return new StaticWeather;
            } elseif ($weatherProvider === 'api') {
                return new ApiWeather;
            }
        });
    }
}
