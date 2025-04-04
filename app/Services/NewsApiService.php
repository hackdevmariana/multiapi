<?php

namespace App\Services;

use jcobhams\NewsApi\NewsApi;

class NewsApiService
{
    protected $newsApi;

    public function __construct()
    {
        $this->newsApi = new NewsApi(env('NEWSAPI_KEY'));
    }

    // Obtener titulares principales
    public function getTopHeadlines($language = 'es', $category = null, $country = null)
    {
        return $this->newsApi->getTopHeadlines(
            null, // Query
            null, // Sources
            $country,
            $category,
            null, // Page Size
            null  // Page
        );
    }

    // Obtener noticias por palabras clave
    public function getEverything($query, $language = 'es')
    {
        return $this->newsApi->getEverything(
            $query, // Query
            null,   // Sources
            null,   // Domains
            null,   // Exclude Domains
            null,   // From
            null,   // To
            $language,
            null,   // Sort By
            null,   // Page Size
            null    // Page
        );
    }
}
