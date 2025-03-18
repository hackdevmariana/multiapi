<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RandomController extends Controller
{
    public function randomNumber()
    {
        return response()->json(['number' => rand()]);
    }

}
