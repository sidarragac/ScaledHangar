<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherApiService
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.weather.api_key');
    }

    public function getActualWeather(): int
    {
        $url = 'http://api.weatherstack.com/current?access_key=' . $this->apiKey . '&query=Medellin';
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            return (int) round($data['current']['temperature']);
        }

        return 0;
    }
}