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


    public function toEnglish($word)
    {
        $url = 'https://api.mymemory.translated.net/get';

        // Usar caché para traducción si es necesario
        $translation = Cache::remember('toenglish_' . $word, 60, function () use ($url, $word) {
            $response = Http::get($url, [
                'q' => $word,
                'langpair' => 'es|en', // Español a Inglés
            ]);

            return $response->successful() ? $response->json()['responseData']['translatedText'] : null;
        });

        if ($translation) {
            return response()->json(['word' => $word, 'translation' => $translation], 200);
        }

        return response()->json(['error' => 'No se pudo traducir la palabra'], 400);
    }

    /**
     * Translate a word from English to Spanish.
     *
     * @param string $word
     * @return \Illuminate\Http\JsonResponse
     */
    public function toSpanish($word)
    {
        $url = 'https://api.mymemory.translated.net/get';

        // Usar caché para traducción si es necesario
        $translation = Cache::remember('tospanish_' . $word, 60, function () use ($url, $word) {
            $response = Http::get($url, [
                'q' => $word,
                'langpair' => 'en|es', // Inglés a Español
            ]);

            return $response->successful() ? $response->json()['responseData']['translatedText'] : null;
        });

        if ($translation) {
            return response()->json(['word' => $word, 'translation' => $translation], 200);
        }

        return response()->json(['error' => 'No se pudo traducir la palabra'], 400);
    }


    public function getSynonyms($word)
    {
        $url = 'https://es.wiktionary.org/w/api.php';

        // Almacenar resultados en caché por 60 minutos
        $synonyms = Cache::remember('synonyms_' . $word, 60, function () use ($url, $word) {
            $response = Http::get($url, [
                'action' => 'query',
                'titles' => $word,
                'prop' => 'extracts',
                'explaintext' => true,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Procesar los datos para extraer sinónimos
                $pages = $data['query']['pages'] ?? [];
                foreach ($pages as $page) {
                    if (isset($page['extract']) && str_contains($page['extract'], 'Sinónimos')) {
                        // Extraer los sinónimos de la sección correspondiente
                        $extract = $page['extract'];
                        preg_match('/Sinónimos:(.*?)(\n|$)/', $extract, $matches);
                        return isset($matches[1]) ? explode(',', trim($matches[1])) : [];
                    }
                }
            }

            return null;
        });

        if ($synonyms) {
            return response()->json(['word' => $word, 'synonyms' => $synonyms], 200);
        }

        return response()->json(['error' => 'No se encontraron sinónimos'], 404);
    }

    public function getAntonyms($word)
    {
        $url = 'https://es.wiktionary.org/w/api.php';

        // Almacenar resultados en caché por 60 minutos
        $antonyms = Cache::remember('antonyms_' . $word, 60, function () use ($url, $word) {
            $response = Http::get($url, [
                'action' => 'query',
                'titles' => $word,
                'prop' => 'extracts',
                'explaintext' => true,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Procesar los datos para extraer antónimos
                $pages = $data['query']['pages'] ?? [];
                foreach ($pages as $page) {
                    if (isset($page['extract']) && str_contains($page['extract'], 'Antónimos')) {
                        // Extraer los antónimos de la sección correspondiente
                        $extract = $page['extract'];
                        preg_match('/Antónimos:(.*?)(\n|$)/', $extract, $matches);
                        return isset($matches[1]) ? explode(',', trim($matches[1])) : [];
                    }
                }
            }

            return null;
        });

        if ($antonyms) {
            return response()->json(['word' => $word, 'antonyms' => $antonyms], 200);
        }

        return response()->json(['error' => 'No se encontraron antónimos'], 404);
    }
    public function getEtymology($word)
    {
        $url = 'https://es.wiktionary.org/w/api.php';

        $etymology = Cache::remember('etymology_' . $word, 60, function () use ($url, $word) {
            $response = Http::get($url, [
                'action' => 'query',
                'titles' => $word,
                'prop' => 'extracts',
                'explaintext' => true,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $pages = $data['query']['pages'] ?? [];
                foreach ($pages as $page) {
                    if (isset($page['extract']) && str_contains($page['extract'], 'Etimología')) {
                        $extract = $page['extract'];
                        preg_match('/Etimología:(.*?)(\n|$)/', $extract, $matches);
                        return isset($matches[1]) ? trim($matches[1]) : null;
                    }
                }
            }

            return null;
        });

        if ($etymology) {
            return response()->json(['word' => $word, 'etymology' => $etymology], 200);
        }

        return response()->json(['error' => 'No se encontró información sobre la etimología'], 404);
    }
    public function getRelatedWords($word)
    {
        $url = 'https://es.wiktionary.org/w/api.php';

        // Almacenar resultados en caché por 60 minutos
        $relatedWords = Cache::remember('related_words_' . $word, 60, function () use ($url, $word) {
            $response = Http::get($url, [
                'action' => 'query',
                'titles' => $word,
                'prop' => 'extracts',
                'explaintext' => true,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $pages = $data['query']['pages'] ?? [];
                foreach ($pages as $page) {
                    if (isset($page['extract'])) {
                        $extract = $page['extract'];

                        // Buscar secciones específicas de palabras relacionadas
                        $related = [];
                        if (str_contains($extract, 'Relaciones')) {
                            preg_match('/Relaciones:(.*?)(\n|$)/', $extract, $matches);
                            $related = isset($matches[1]) ? explode(',', trim($matches[1])) : [];
                        }

                        return $related;
                    }
                }
            }

            return null;
        });

        if ($relatedWords) {
            return response()->json(['word' => $word, 'related_words' => $relatedWords], 200);
        }

        return response()->json(['error' => 'No se encontraron palabras relacionadas'], 404);
    }

}
