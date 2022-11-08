<?php    // src/Service/HighlanderForecastGenerator

namespace App\Service;

class HighlanderForecastGenerator
{
    public function getForecast(): string
    {
        $forecasts = [
            "It's going to rain!",
            "It's going to snow!",
            "It's going to be a lovely sunny weather!",
            "It's going to be windy!",
        ];

        $index = array_rand($forecasts);
        $forecast = $forecasts[$index];

        return $forecast;
    }

    public function getForecastByKey($key): string
    {
        $forecasts = [
            'rain' => "It's going to rain!",
            'snow' => "It's going to snow!",
            'sun' => "It's going to be a lovely sunny weather!",
            'wind' => "It's going to be windy!",
        ];

        $forecast = $forecasts[$key];

        return $forecast;
    }
}