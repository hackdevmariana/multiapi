<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SunTimesController extends Controller
{
    protected $provinces = [
        'madrid' => ['lat' => 40.416775, 'lng' => -3.703790],
        'barcelona' => ['lat' => 41.385064, 'lng' => 2.173404],
        
        // Agregar el resto de provincias
    ];

    public function getSunTimes(Request $request, $province)
    {
        // Validar que la provincia exista en el listado
        if (!isset($this->provinces[$province])) {
            return response()->json(['error' => 'Provincia no válida'], 400);
        }

        // Obtener latitud y longitud
        $location = $this->provinces[$province];

        // Hacer la solicitud a la API Sunrise-Sunset
        $response = Http::get('https://api.sunrise-sunset.org/json', [
            'lat' => $location['lat'],
            'lng' => $location['lng'],
            'date' => 'today',
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo obtener los datos de la API'], 500);
        }

        // Devolver los datos de salida y puesta del sol
        return response()->json($response->json()['results']);
    }
}
