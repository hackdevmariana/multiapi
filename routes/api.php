<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/v1/check', function () {
    return response()->json(['status' => 'OK']);
});

Route::get('/v1/generate-password', function (Illuminate\Http\Request $request) {
    $length = $request->query('length', 12); // Longitud por defecto: 12 caracteres
    $password = Str::random($length);
    return response()->json(['password' => $password]);
});

Route::get('/v1/generate-qr', function (Illuminate\Http\Request $request) {
    $text = $request->query('text', 'Default text');
    $qrCode = QrCode::size(200)->generate($text);

    return response($qrCode, 200)->header('Content-Type', 'image/svg+xml');
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

