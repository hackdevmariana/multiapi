<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WordController extends Controller
{
    // Método para obtener información de una palabra 
    public function getWordInfo($word)
    {
        $url = 'https://en.wiktionary.org/w/api.php';

        $data = Cache::remember('word_' . $word, 60, function () use ($url, $word) {
            return Http::get($url, [
                'action' => 'query',
                'titles' => $word,
                'prop' => 'extracts',
                'explaintext' => true,
                'format' => 'json',
            ])->json();
        });

        if (isset($data['query']['pages'])) {
            return response()->json($data, 200);
        }

        return response()->json(['error' => 'No se pudo obtener información de la palabra'], 400);
    }

    // Método para traducir palabras
    public function translateWord(Request $request)
    {
        $word = $request->input('word');
        $targetLanguage = $request->input('language', 'es'); // Idioma por defecto: español

        // URL para un servicio de traducción o Wiktionary (puedes usar una API externa si es necesario)
        $url = 'https://api.mymemory.translated.net/get';

        // Solicitar la traducción
        $response = Http::get($url, [
            'q' => $word,
            'langpair' => "en|$targetLanguage",
        ]);

        // Validar la respuesta
        if ($response->successful()) {
            $translation = $response->json()['responseData']['translatedText'];
            return response()->json(['word' => $word, 'translation' => $translation], 200);
        }

        return response()->json(['error' => 'No se pudo traducir la palabra'], 400);
    }
}
