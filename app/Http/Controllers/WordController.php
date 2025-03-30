<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WordController extends Controller
{
    /**
     * Get information about a word from Wiktionary API with caching.
     *
     * @param string $word
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWordInfo($word)
    {
        // URL de la API de Wiktionary
        $url = 'https://en.wiktionary.org/w/api.php';

        // Usar caché para almacenar la respuesta durante 60 minutos
        $data = Cache::remember('word_' . $word, 60, function () use ($url, $word) {
            return Http::get($url, [
                'action' => 'query',
                'titles' => $word,
                'prop' => 'extracts',
                'explaintext' => true,
                'format' => 'json',
            ])->json();
        });

        // Verifica si hay datos válidos en la respuesta
        if (isset($data['query']['pages'])) {
            return response()->json($data, 200);
        }

        return response()->json(['error' => 'No se pudo obtener información de la palabra'], 400);
    }
}
