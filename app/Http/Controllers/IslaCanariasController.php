<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IslaCanaria;
use Illuminate\Http\Response;

class IslaCanariasController extends Controller
{
    public function index()
    {
        $islas = IslaCanaria::all(['nombre']); // Selecciona solo los nombres de las islas
        return response()->json($islas, Response::HTTP_OK);
    }
}
