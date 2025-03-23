<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class RssController extends Controller
{
    protected $rssFeeds = [
        'elpais' => 'https://elpais.com/rss/elpais/portada.xml',
        'elmundo' => 'https://e00-elmundo.uecdn.es/elmundo/rss/portada.xml',
        'abc' => 'https://www.abc.es/rss/feeds/abcPortada.xml',
        'lavanguardia' => 'https://www.lavanguardia.com/mvc/feed/rss/home',
        'eldiario' => 'https://www.eldiario.es/rss/',
    ];

    public function index(Request $request)
    {
        $source = $request->input('source'); // Nombre del medio
        $author = $request->input('author'); // Autor a filtrar (opcional)
        $keyword = $request->input('keyword'); // Palabra clave a filtrar (opcional)

        // URLs de los RSS
        $rssFeeds = [
            'elpais' => 'https://ep00.epimg.net/rss/elpais/portada.xml',
            'elmundo' => 'https://e00-elmundo.uecdn.es/elmundo/rss/portada.xml',
            'abc' => 'https://www.abc.es/rss/feeds/abcPortada.xml',
        ];

        if (!isset($rssFeeds[$source])) {
            return response()->json([
                'error' => 'Fuente no válida',
                'source_received' => $source,
                'valid_sources' => array_keys($rssFeeds),
            ], 400);
        }


        $rssUrl = $rssFeeds[$source]; // Obtener la URL del feed

        // Obtener el RSS desde la URL
        $response = Http::get($rssUrl);

        if (!$response->ok()) {
            return response()->json(['error' => 'No se pudo obtener el RSS'], 500);
        }

        // Parsear el feed RSS
        $rssFeed = new SimpleXMLElement($response->body());
        $items = collect($rssFeed->channel->item);

        // Opcional: Devolver los items sin filtrar (para probar)
        return response()->json($items->map(function ($item) {
            return [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'pubDate' => (string) $item->pubDate,
            ];
        }));
    }

    public function getElPais()
    {
        $rssUrl = 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/ultimas-noticias/portada';
        $response = Http::get($rssUrl);

        if (!$response->ok()) {
            return response()->json(['error' => 'No se pudo obtener el RSS'], 500);
        }

        $rssFeed = new SimpleXMLElement($response->body());
        $items = collect($rssFeed->channel->item);

        // Formatear los resultados
        $formattedItems = $items->map(function ($item) {
            return [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'pubDate' => (string) $item->pubDate,
                'description' => (string) $item->description,
            ];
        });

        return response()->json($formattedItems);
    }

    public function getElPaisByAuthor($author)
    {
        $rssUrl = 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/ultimas-noticias/portada';
        $response = Http::get($rssUrl);

        if (!$response->ok()) {
            return response()->json(['error' => 'No se pudo obtener el RSS'], 500);
        }

        $rssFeed = new SimpleXMLElement($response->body());
        $items = collect($rssFeed->channel->item);

        // Filtrar por autor
        $filteredItems = $items->filter(function ($item) use ($author) {
            return isset($item->author) && stripos($item->author, $author) !== false;
        });

        // Formatear los resultados
        $formattedItems = $filteredItems->map(function ($item) {
            return [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'pubDate' => (string) $item->pubDate,
                'description' => (string) $item->description,
                'author' => (string) $item->author ?? 'Desconocido',
            ];
        });

        return response()->json($formattedItems);
    }

    public function getElPaisByKeywords($keywords)
    {
        $rssUrl = 'https://ep00.epimg.net/rss/elpais/portada.xml';
        $response = Http::get($rssUrl);

        if (!$response->ok()) {
            return response()->json(['error' => 'No se pudo obtener el RSS'], 500);
        }

        $rssFeed = new SimpleXMLElement($response->body());
        $items = collect($rssFeed->channel->item);

        // Filtrar por palabras clave
        $filteredItems = $items->filter(function ($item) use ($keywords) {
            return stripos($item->title, $keywords) !== false ||
                stripos($item->description, $keywords) !== false;
        });

        // Formatear los resultados
        $formattedItems = $filteredItems->map(function ($item) {
            return [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'pubDate' => (string) $item->pubDate,
                'description' => (string) $item->description,
            ];
        });

        return response()->json($formattedItems);
    }
    public function getElMundo()
    {
        $rssUrl = 'https://e00-elmundo.uecdn.es/elmundo/rss/portada.xml';
        $response = Http::get($rssUrl);
    
        if (!$response->ok()) {
            return response()->json(['error' => 'No se pudo obtener el RSS'], 500);
        }
    
        $rssFeed = new SimpleXMLElement($response->body());
        $items = collect($rssFeed->channel->item);
    
        // Formatear los resultados
        $formattedItems = $items->map(function ($item) {
            return [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'pubDate' => (string) $item->pubDate,
                'description' => (string) $item->description,
            ];
        });
    
        return response()->json($formattedItems);
    }
    
}
