<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function getTodaysNews()
{
    $cacheKey = 'todays_news';

    return Cache::remember($cacheKey, 0 * 12, function () {
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => '',
            'language' => 'es',
            'apiKey' => env('NEWSAPI_KEY'),
        ]);


        if (!$response->ok()) {
            return ['error' => 'Error al obtener noticias'];
        }

        return $response->json();
    });
}



    public function getNewsByKeywords($keywords)
    {
        // Clave de caché única para las palabras clave
        $cacheKey = 'todays_news_' . md5($keywords);

        $news = Cache::remember($cacheKey, 60 * 12, function () use ($keywords) {
            // Llamada a la API de NewsAPI con palabras clave
            $response = Http::get('https://newsapi.org/v2/everything', [
                'q' => $keywords,
                'language' => 'es', // Idioma español
                'apiKey' => env('NEWSAPI_KEY'), // Clave de API
            ]);

            // Comprobación de éxito
            if ($response->ok()) {
                return $response->json();
            }

            // Manejo de error si falla la solicitud
            return ['error' => $response->json()['message'] ?? 'Error en la API de NewsAPI'];
        });

        return response()->json($news);
    }
}
