<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SunTimesController extends Controller
{
    protected $provinces = [
        'madrid' => ['lat' => 40.416775, 'lng' => -3.703790],
        'barcelona' => ['lat' => 41.385064, 'lng' => 2.173404],
        'valencia' => ['lat' => 39.469907, 'lng' => -0.376288],
        'sevilla' => ['lat' => 37.388630, 'lng' => -5.982328],
        'zaragoza' => ['lat' => 41.648823, 'lng' => -0.889085],
        'malaga' => ['lat' => 36.721274, 'lng' => -4.421399],
        'bilbao' => ['lat' => 43.263012, 'lng' => -2.934985],
        'valladolid' => ['lat' => 41.652251, 'lng' => -4.724532],
        'cordoba' => ['lat' => 37.888175, 'lng' => -4.779383],
        'granada' => ['lat' => 37.177336, 'lng' => -3.598557],
        'la-coruna' => ['lat' => 43.362343, 'lng' => -8.411540],
        'lugo' => ['lat' => 43.012527, 'lng' => -7.555854],
        'orense' => ['lat' => 42.335506, 'lng' => -7.863881],
        'pontevedra' => ['lat' => 42.428191, 'lng' => -8.644352],
        'asturias' => ['lat' => 43.366440, 'lng' => -5.851580],
        'cantabria' => ['lat' => 43.182839, 'lng' => -3.987842],
        'avila' => ['lat' => 40.656796, 'lng' => -4.681721],
        'burgos' => ['lat' => 42.343993, 'lng' => -3.696906],
        'leon' => ['lat' => 42.598726, 'lng' => -5.567096],
        'palencia' => ['lat' => 42.009619, 'lng' => -4.528488],
        'salamanca' => ['lat' => 40.970103, 'lng' => -5.663539],
        'segovia' => ['lat' => 40.942903, 'lng' => -4.108806],
        'soria' => ['lat' => 41.764012, 'lng' => -2.467597],
        'zamora' => ['lat' => 41.503438, 'lng' => -5.744373],
        'albacete' => ['lat' => 38.994349, 'lng' => -1.856436],
        'ciudad-real' => ['lat' => 38.984828, 'lng' => -3.929066],
        'cuenca' => ['lat' => 40.070392, 'lng' => -2.137416],
        'guadalajara' => ['lat' => 40.633333, 'lng' => -3.166667],
        'toledo' => ['lat' => 39.862831, 'lng' => -4.027323],
        'almeria' => ['lat' => 36.834047, 'lng' => -2.463714],
        'cadiz' => ['lat' => 36.516380, 'lng' => -6.282764],
        'huelva' => ['lat' => 37.261421, 'lng' => -6.944722],
        'jaen' => ['lat' => 37.779594, 'lng' => -3.784906],
        'badajoz' => ['lat' => 38.878596, 'lng' => -6.970306],
        'caceres' => ['lat' => 39.475276, 'lng' => -6.372241],
        'la-coruña' => ['lat' => 43.362343, 'lng' => -8.411540],
        'las-palmas' => ['lat' => 28.123546, 'lng' => -15.436257],
        'tenerife' => ['lat' => 28.468239, 'lng' => -16.254618],
        'huesca' => ['lat' => 42.140100, 'lng' => -0.408890],
        'teruel' => ['lat' => 40.341905, 'lng' => -1.106351],
        'navarra' => ['lat' => 42.812526, 'lng' => -1.645774],
        'la-rioja' => ['lat' => 42.287076, 'lng' => -2.539603],
        'ceuta' => ['lat' => 35.889387, 'lng' => -5.319786],
        'melilla' => ['lat' => 35.292328, 'lng' => -2.938097],
        'guipuzcoa' => ['lat' => 43.312035, 'lng' => -1.978080],
        'vizcaya' => ['lat' => 43.263012, 'lng' => -2.934985],
        'bizkaia' => ['lat' => 43.263012, 'lng' => -2.934985],
        'alava' => ['lat' => 42.846455, 'lng' => -2.673459],
        'araba' => ['lat' => 42.846455, 'lng' => -2.673459],
        'baleares' => ['lat' => 39.611026, 'lng' => 2.928260],
        'islas-baleares' => ['lat' => 39.611026, 'lng' => 2.928260],

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
