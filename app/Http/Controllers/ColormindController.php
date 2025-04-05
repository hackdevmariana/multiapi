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

    // Generar paleta personalizada con colores fijos
    public function generateCustomPalette()
    {
        // Ejemplo: fijar un color y dejar que la API genere el resto
        $response = Http::post(env('COLORMIND_API_URL'), [
            'input' => [[255, 0, 0], "N", "N", "N", "N"], // Rojo fijado, el resto son "N" para generar
        ]);

        if ($response->ok()) {
            return response()->json([
                'palette' => $response->json()['result'],
            ]);
        }

        return response()->json(['error' => 'No se pudo generar la paleta personalizada.'], $response->status());
    }

    // Consultar modelos disponibles en Colormind
    public function getAvailableModels()
    {
        $response = Http::post(env('COLORMIND_API_URL'), [
            'method' => 'getModels', // Esto depende de que el endpoint soporte consulta de modelos
        ]);

        if ($response->ok()) {
            return response()->json([
                'models' => $response->json(),
            ]);
        }

        return response()->json(['error' => 'No se pudieron obtener los modelos disponibles.'], $response->status());
    }
}
