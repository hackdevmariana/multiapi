<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Str;

Route::get('/v1/check', function () {
    return response()->json(['status' => 'OK']);
});

Route::get('/v1/generate-password', function (Illuminate\Http\Request $request) {
    $length = $request->query('length', 12); // Longitud por defecto: 12 caracteres
    $password = Str::random($length);
    return response()->json(['password' => $password]);
});


Route::get('/v1/uuid', function () {
    return response()->json(['uuid' => Str::uuid()]);
});

Route::get('/v1/datetime', function () {
    return response()->json(['datetime' => now()->toDateTimeString()]);
});

Route::get('/v1/{info}', [ApiController::class, 'getInfo']);

