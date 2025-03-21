<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ExchangeController extends Controller
{
    /**
     * Convierte de dólares a euros
     */
    public function dolarToEuro()
    {
        // Hacer solicitud a la API
        $response = Http::get('https://cdn.dinero.today/api/latest.json');

        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo conectar con la API'], 500);
        }

        // Obtener el tipo de cambio USD a EUR
        $data = $response->json();
        $usdToEur = $data['rates']['EUR'] ?? null;

        if (!$usdToEur) {
            return response()->json(['error' => 'No se pudo obtener la tasa de cambio'], 400);
        }

        return response()->json([
            'from' => 'USD',
            'to' => 'EUR',
            'rate' => $usdToEur,
        ]);
    }

}
