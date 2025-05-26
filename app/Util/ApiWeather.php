<?php

namespace App\Util;

use App\Interfaces\WeatherProviderInterface;
use App\Services\WeatherApiService;

class ApiWeather implements WeatherProviderInterface
{
    public function getActualWeather(): int
    {
        $weatherService = new WeatherApiService();
        $temperature = $weatherService->getActualWeather();

        return $temperature;
    }
}