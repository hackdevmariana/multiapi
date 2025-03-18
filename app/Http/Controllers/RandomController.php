<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RandomController extends Controller
{
    public function randomNumber()
    {
        return response()->json(['number' => rand()]);
    }
    public function randomDecimal()
    {
        return response()->json(['decimal' => rand(0, 100) / 10]);
    }
}
