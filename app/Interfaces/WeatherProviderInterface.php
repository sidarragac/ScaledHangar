<?php

namespace App\Interfaces;

interface WeatherProviderInterface
{
    public function getActualWeather(): int;
}
