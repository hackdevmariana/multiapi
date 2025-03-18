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
    public function randomNumberInRange($min, $max)
    {
        return response()->json(['number' => rand((int)$min, (int)$max)]);
    }
    public function randomColor()
    {
        $color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
        return response()->json(['color' => $color]);
    }
}
