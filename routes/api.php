<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\RandomController;
use App\Http\Controllers\ComunidadAutonomaController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\IslaCanariasController;
use App\Http\Controllers\IslaBalearController;
use App\Http\Controllers\WeatherController;

use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\CryptoExchangeController;

use App\Http\Controllers\ElectricityPriceController;
use App\Http\Controllers\RssController;
use App\Http\Controllers\SunTimesController;
use App\Http\Controllers\WordController;



$fiat = ['euro', 'dolar'];
$cryptos = ['bitcoin', 'ethereum', 'binance', 'solana', 'cardano', 'doge', 'monero'];



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
        Route::get('string/{length}', [RandomController::class, 'randomString']);
    });
    Route::get('/comunidadesautonomas', [ComunidadAutonomaController::class, 'index']);
    Route::get('/provinces/all', [ProvinciaController::class, 'all']);
    Route::get('/provinces/{community}', [ProvinciaController::class, 'byCommunity']);
    Route::get('/islas/canarias', [IslaCanariasController::class, 'index']);
    Route::get('/islas/baleares', [IslaBalearController::class, 'index']);

    Route::prefix('weather')->group(function () {
        Route::get('current/{city}', [WeatherController::class, 'getCurrentWeather']);
        Route::get('forecast/{city}', [WeatherController::class, 'getWeatherForecast']);
        Route::get('coordinates/{lat}/{lon}', [WeatherController::class, 'getWeatherByCoordinates']);
        Route::get('uv-index/{lat}/{lon}', [WeatherController::class, 'getUvIndex']);
        Route::get('city/list', [WeatherController::class, 'listCities']);
    });

    Route::get('/dolar/euro', [ExchangeController::class, 'dolarToEuro']);
    Route::get('/euro/dolar', [ExchangeController::class, 'euroToDolar']);

    Route::get('/crypto/{from}/{to}', [CryptoExchangeController::class, 'getExchange']);


    Route::get('/electricityprice/today', [ElectricityPriceController::class, 'getTodayPrice']);
    Route::get('/electricityprice/now', [ElectricityPriceController::class, 'getNowPrice']);
    Route::get('/electricityprice/{day}', [ElectricityPriceController::class, 'getPriceByDay']);

    Route::get('{info}', [ApiController::class, 'getInfo']);

    Route::prefix('/rss')->group(function () {
        Route::get('/elpais', [RssController::class, 'getElPais']);
        Route::get('/elpais/author/{author}', [RssController::class, 'getElPaisByAuthor']);
        Route::get('/elpais/keywords/{keywords}', [RssController::class, 'getElPaisByKeywords']);

        Route::get('/elmundo', [RssController::class, 'getElMundo']);
        Route::get('/elmundo/author/{author}', [RssController::class, 'getElMundoByAuthor']);
        Route::get('/elmundo/keywords/{keywords}', [RssController::class, 'getElMundoByKeywords']);

    });
    Route::get('sun/{province}', [SunTimesController::class, 'getSunTimes']);
    Route::get('definition/{word}', [WordController::class, 'getWordInfo'])->name('word.info');
    Route::get('toenglish/{word}', [WordController::class, 'toEnglish'])->name('translate.toenglish');
});
