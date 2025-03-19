<?php
namespace App\Http\Controllers;

use App\Models\IslaBalear;
use Illuminate\Http\Response;

class IslaBalearController extends Controller
{
    /**
     * Devuelve el listado de islas Baleares.
     */
    public function index()
    {
        $islas = IslaBalear::all(['nombre']); // Selecciona solo los nombres de las islas
        return response()->json($islas, Response::HTTP_OK);
    }
}
