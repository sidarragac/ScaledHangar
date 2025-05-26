<?php

namespace App\Util;

use App\Interfaces\WeatherProviderInterface;

class StaticWeather implements WeatherProviderInterface
{
    public function getActualWeather(): int
    {
        $hour = (int) date('H');
        $temperature = 0;
        switch ($hour){
            case 0:
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                $temperature = 17;
                break;
            case 6:
            case 7:
            case 8:
            case 9:
                $temperature = 19;
                break;
            case 10:
            case 11:
            case 12:
                $temperature = 22;
                break;
            case 13:
            case 14:
            case 15:
            case 16:
                $temperature = 26;
                break;
            case 17:
            case 18:
            case 19:
                $temperature = 23;
                break;
            case 20:
            case 21:
            case 22:
            case 23:
                $temperature = 20;
                break;
        }

        return $temperature;
    }
}