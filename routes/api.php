<?php
use Illuminate\Support\Facades\Route;

Route::get('/v1/appname', function () {
    return response()->json([
        'app_name' => config('app.name'),
    ]);
});
Route::get('/v1/yourip', function () {
    return response()->json(['ip' => request()->ip()]);
});