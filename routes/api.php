<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\RandomController;

Route::prefix('v1')->group(function () {
    Route::get('check', [UtilityController::class, 'check']);
    Route::get('password', [UtilityController::class, 'generatePassword']);
    Route::get('limit', [UtilityController::class, 'limitText']);
    Route::get('slug/{text}', [UtilityController::class, 'slugify']);
    Route::get('camel/{text}', [UtilityController::class, 'camelCase']);
    Route::get('kebab/{text}', [UtilityController::class, 'kebabCase']);
    Route::get('title/{text}', [UtilityController::class, 'titleCase']);
    Route::get('snake/{text}', [UtilityController::class, 'snakeCase']);
    Route::get('generate-qr', [UtilityController::class, 'generateQrCode']);
    Route::get('validate-email/{email}', [UtilityController::class, 'validateEmail']);
    Route::get('uuid', [UtilityController::class, 'generateUuid']);
    Route::get('datetime', [UtilityController::class, 'getCurrentDateTime']);
    Route::get('/time-diff', [UtilityController::class, 'timeDiff']);
    Route::get('/time-diff-es', [UtilityController::class, 'timeDiffEs']);
    Route::prefix('random')->group(function () {
        Route::get('number', [RandomController::class, 'randomNumber']);
        Route::get('decimal', [RandomController::class, 'randomDecimal']);
        Route::get('number/{min}/{max}', [RandomController::class, 'randomNumberInRange']);
        Route::get('color', [RandomController::class, 'randomColor']);
        Route::get('decimalcolor', [RandomController::class, 'randomDecimalColor']);
        Route::get('lowercaseletter', [RandomController::class, 'randomLowercaseLetter']);
        Route::get('uppercaseletter', [RandomController::class, 'randomUppercaseLetter']);
        Route::get('simbol', [RandomController::class, 'randomSymbol']);
        Route::get('uuid', [RandomController::class, 'randomUuid']);
        Route::get('boolean', [RandomController::class, 'randomBoolean']);

    });


    Route::get('{info}', [ApiController::class, 'getInfo']);    
});
