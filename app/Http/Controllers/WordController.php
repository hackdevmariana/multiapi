<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WordController extends Controller
{
    /**
     * Get information about a word from Wiktionary API.
     *
     * @param string $word
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWordInfo($word)
    {
        // URL de la API de MediaWiki
        $url = 'https://en.wiktionary.org/w/api.php';

        // Parámetros de la solicitud
        $response = Http::get($url, [
            'action' => 'query',
            'titles' => $word,
            'prop' => 'extracts',
            'explaintext' => true,
            'format' => 'json',
        ]);

        // Verifica si la solicitud tuvo éxito
        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }

        return response()->json(['error' => 'No se pudo obtener la información'], 400);
    }
}
