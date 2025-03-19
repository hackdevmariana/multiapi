<?php
namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    /**
     * Obtiene todas las provincias.
     */
    public function all()
    {
        $provincias = Provincia::all(['nombre_provincia', 'comunidad_autonoma', 'capital_provincia']);
        return response()->json($provincias);
    }

    /**
     * Obtiene las provincias de una comunidad autónoma.
     */
    public function byCommunity($community)
    {
        $provincias = Provincia::where('comunidad_autonoma', 'LIKE', "%{$community}%")
            ->get(['nombre_provincia', 'capital_provincia']);

        return response()->json($provincias);
    }
}
