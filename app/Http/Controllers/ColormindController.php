<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ColormindController extends Controller
{
    // Generar paleta aleatoria
    public function generateRandomPalette()
    {
        $response = Http::post(env('COLORMIND_API_URL'), [
            'model' => 'default', // Modelo por defecto
        ]);

        if ($response->ok()) {
            return response()->json([
                'palette' => $response->json()['result'],
            ]);
        }

        return response()->json(['error' => 'No se pudo generar la paleta de colores.'], $response->status());
    }

}
