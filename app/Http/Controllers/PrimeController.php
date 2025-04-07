<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimeController extends Controller
{
    public function isPrime($number)
    {
        // Validación para asegurarse de que el número sea positivo y entero
        if ($number <= 1) {
            return response()->json([
                'number' => $number,
                'is_prime' => false,
                'message' => 'El número debe ser mayor que 1.'
            ], 400);
        }

        if (!is_numeric($number) || intval($number) != $number) {
            return response()->json([
                'error' => 'El parámetro debe ser un número entero.'
            ], 400);
        }

        // Verificación de si el número es primo
        $isPrime = $this->checkPrime($number);

        return response()->json([
            'number' => $number,
            'is_prime' => $isPrime
        ]);
    }

    private function checkPrime($number)
    {
        // Un número es primo si solo es divisible por 1 y por sí mismo
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                return false; // Tiene un divisor, no es primo
            }
        }
        return true; // Es primo
    }
}
