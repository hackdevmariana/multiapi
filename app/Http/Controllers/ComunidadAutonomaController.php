<?php

namespace App\Http\Controllers;
use App\Models\ComunidadAutonoma;

use Illuminate\Http\Request;

class ComunidadAutonomaController extends Controller
{



    public function index()
    {
        // Obtiene solo los nombres de las comunidades autónomas
        $nombres = ComunidadAutonoma::pluck('nombre');

        return response()->json($nombres);
    }

}
