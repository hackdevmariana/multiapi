<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimeFactorsController extends Controller
{
    public function getPrimeFactors($number)
    {
        // Validación para asegurarse de que el número sea positivo
        if ($number < 1) {
            return response()->json([
                'error' => 'El número debe ser mayor o igual a 1.'
            ], 400);
        }

        // Calcula los factores primos
        $primeFactors = $this->calculatePrimeFactors($number);

        return response()->json([
            'number' => $number,
            'prime_factors' => $primeFactors
        ]);
    }

    private function calculatePrimeFactors($number)
    {
        $factors = [];
        $divisor = 2;

        while ($number > 1) {
            while ($number % $divisor == 0) {
                $factors[] = $divisor;
                $number /= $divisor;
            }
            $divisor++;
        }

        return $factors;
    }
}
