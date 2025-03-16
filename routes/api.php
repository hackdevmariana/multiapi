<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

Route::get('/v1/check', function () {
    return response()->json(['status' => 'OK']);
});

Route::get('/v1/generate-password', function (Illuminate\Http\Request $request) {
    $length = $request->query('length', 12); // Longitud por defecto: 12 caracteres
    $password = Str::random($length);
    return response()->json(['password' => $password]);
});

Route::get('/v1/slug/{text}', function ($text) {
    // Convertir el texto en un slug usando la función de Laravel
    $slug = Str::slug($text, '-'); // Separa con guiones

    return response()->json([
        'slug' => $slug,
    ]);
});


Route::get('/v1/generate-qr', function (Illuminate\Http\Request $request) {
    $text = $request->query('text', 'Default text'); 
    $size = max(100, min((int) $request->query('size', 200), 1000)); 
    $qrCode = QrCode::format('png')->size($size)->generate($text);
    return response($qrCode, 200)->header('Content-Type', 'image/png');
});

Route::get('/v1/validate-email/{email}', function ($email) {
    $isValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;

    return response()->json([
        'email' => $email,
        'valid' => $isValid,
    ]);
});

Route::get('/v1/uuid', function () {
    return response()->json(['uuid' => Str::uuid()]);
});

Route::get('/v1/datetime', function () {
    return response()->json(['datetime' => now()->toDateTimeString()]);
});

Route::get('/v1/{info}', [ApiController::class, 'getInfo']);

