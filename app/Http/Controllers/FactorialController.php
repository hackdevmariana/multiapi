<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FactorialController extends Controller
{
    public function calculate($number)
    {
        // Validación para asegurarse de que el número sea no negativo
        if ($number < 0) {
            return response()->json([
                'error' => 'El número debe ser mayor o igual a 0.'
            ], 400);
        }

        // Calcula el factorial
        $factorial = $this->factorial($number);

        return response()->json([
            'number' => $number,
            'factorial' => $factorial
        ]);
    }

    private function factorial($number)
    {
        // Si el número es 0 o 1, el factorial es 1
        if ($number === 0 || $number === 1) {
            return 1;
        }

        // Caso general: multiplicar recursivamente
        return $number * $this->factorial($number - 1);
    }
}
