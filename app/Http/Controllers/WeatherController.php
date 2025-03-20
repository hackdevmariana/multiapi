<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHER_KEY');
    }

    public function getCurrentWeather($city)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric', // Opcional: usa unidades métricas
        ]);

        return response()->json($response->json());
    }

    public function getWeatherForecast($city)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric',
        ]);

        return response()->json($response->json());
    }

    public function getWeatherByCoordinates($lat, $lon)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'lat' => $lat,
            'lon' => $lon,
            'appid' => $this->apiKey,
            'units' => 'metric',
        ]);

        return response()->json($response->json());
    }

}
