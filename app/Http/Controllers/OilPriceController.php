<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class OilPriceController extends Controller
{
    public function getOilPrice()
    {
        return Cache::remember('oil_price', 60 * 10, function () {
        $response = Http::withHeaders([
            'Authorization' => 'Token ' . env('OILPRICEAPI_KEY'),
        ])->get('https://api.oilpriceapi.com/v1/prices/latest');

        // Verificar si la solicitud fue exitosa
        if ($response->ok()) {
            $data = $response->json();

            // Extraer el precio del barril de crudo
            $price = $data['data']['price'] ?? null;
            $commodity = $data['data']['commodity'] ?? 'Unknown';

            return response()->json([
                'commodity' => $commodity,
                'price' => $price,
                'currency' => $data['data']['currency'] ?? 'USD',
                'unit' => $data['data']['unit'] ?? 'barrel',
            ]);
        }

        // Manejo de errores
        return response()->json([
            'error' => 'No se pudo obtener el precio del petróleo.',
            'details' => $response->body(),
        ], $response->status());
    }
}
}


