<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ElectricityPriceController extends Controller
{
    private $apiUrl = 'https://apidatos.ree.es/es/datos/mercados/precios-mercados-tiempo-real';

    /**
     * Obtiene el precio de la electricidad para hoy.
     */
    public function getTodayPrice()
    {
        $today = Carbon::today()->toDateString();
        $url = $this->buildApiUrl($today, $today);

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo obtener los datos de la electricidad para hoy.'], 500);
        }

        return response()->json([
            'date' => $today,
            'prices' => $response->json(),
        ]);
    }

    /**
     * Obtiene el precio de la electricidad para un día específico.
     */
    public function getPriceByDay($day)
    {
        $requestedDay = Carbon::parse($day);

        if ($requestedDay->isFuture()) {
            return response()->json(['error' => 'El día solicitado no puede ser en el futuro.'], 400);
        }

        $url = $this->buildApiUrl($requestedDay->toDateString(), $requestedDay->toDateString());
        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo obtener los datos de la electricidad para el día solicitado.'], 500);
        }

        return response()->json([
            'date' => $requestedDay->toDateString(),
            'prices' => $response->json(),
        ]);
    }
    public function getNowPrice()
{
    $today = Carbon::now()->toDateString(); // Fecha de hoy
    $url = $this->buildApiUrl($today, $today);

    $response = Http::get($url);

    if ($response->failed()) {
        return response()->json(['error' => 'No se pudo obtener los datos de la electricidad para ahora.'], 500);
    }

    $data = $response->json();
    $pvpcLastPrice = null; // Último precio PVPC
    $spotLastPrice = null; // Último precio Spot

    // Verificar si existen datos en el array 'included'
    if (isset($data['included'])) {
        // Extraer el último precio de PVPC (primer grupo)
        if (isset($data['included'][0]['attributes']['values'])) {
            $valuesPVPC = $data['included'][0]['attributes']['values'];
            $pvpcLastPrice = end($valuesPVPC); // Obtiene el último elemento del array
        }

        // Extraer el último precio del mercado Spot (segundo grupo)
        if (isset($data['included'][1]['attributes']['values'])) {
            $valuesSpot = $data['included'][1]['attributes']['values'];
            $spotLastPrice = end($valuesSpot); // Obtiene el último elemento del array
        }
    }

    // Si no encontramos precios, devolvemos error
    if ($pvpcLastPrice === null && $spotLastPrice === null) {
        return response()->json(['error' => 'No se encontró información de precios recientes.'], 404);
    }

    // Devolver el resultado con los precios
    return response()->json([
        'date' => $today,
        'pvpc_last_price' => $pvpcLastPrice,
        'spot_last_price' => $spotLastPrice,
    ]);
}

    
    /**
     * Construye la URL de la API.
     */
    private function buildApiUrl($startDate, $endDate)
    {
        return $this->apiUrl . "?start_date={$startDate}T00:00&end_date={$endDate}T23:59&time_trunc=hour";
    }
}
