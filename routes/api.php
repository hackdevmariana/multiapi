<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/v1/datetime', function () {
    return response()->json(['datetime' => now()->toDateTimeString()]);
});

Route::get('/v1/{info}', [ApiController::class, 'getInfo']);


