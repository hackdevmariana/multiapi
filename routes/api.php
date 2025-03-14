<?php
use Illuminate\Support\Facades\Route;

Route::get('/app-name', function () {
    return response()->json([
        'app_name' => config('app.name'),
    ]);
});
