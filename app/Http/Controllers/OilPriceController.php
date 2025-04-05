<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class OilPriceController extends Controller
{
    public function getOilPrice()
    {
        // Usar caché para evitar múltiples solicitudes a la API en un corto tiempo
        return Cache::remember('oil_price', 60 * 60 * 24, function () {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . env('OILPRICEAPI_KEY'),
            ])->get('https://api.oilpriceapi.com/v1/prices/latest');

            // Verificar si la solicitud fue exitosa
            if ($response->ok()) {
                $data = $response->json();

                // Extraer el precio del barril de crudo
                $price = $data['data']['price'] ?? null;
                $commodity = $data['data']['commodity'] ?? 'Unknown';

                // Retornar un array con la información del precio
                return [
                    'commodity' => $commodity,
                    'price' => $price,
                    'currency' => $data['data']['currency'] ?? 'USD',
                    'unit' => $data['data']['unit'] ?? 'barrel',
                ];
            }

            // Manejo de errores si la API falla
            return [
                'error' => 'No se pudo obtener el precio del petróleo.',
                'details' => $response->body(),
            ];
        });
    }
}

