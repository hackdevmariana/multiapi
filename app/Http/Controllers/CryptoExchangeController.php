<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CryptoExchangeController extends Controller
{
    private $coinLoreApi = 'https://api.coinlore.net/api/tickers/';
    private $dineroTodayApi = 'https://cdn.dinero.today/api/latest.json';

    /**
     * Convierte entre criptomonedas y monedas fiat (euro, dólar)
     */
    public function getExchange($from, $to)
    {
        // Obtener el tipo de cambio dólar-euro desde Dinero.today
        $fiatRates = $this->getFiatRates();

        if (!$fiatRates) {
            return response()->json(['error' => 'No se pudo obtener las tasas de cambio de Dinero.today'], 500);
        }

        // Obtener los precios de criptomonedas desde CoinLore
        $cryptos = $this->getCryptoPrices();

        if (!$cryptos) {
            return response()->json(['error' => 'No se pudo conectar con la API de CoinLore'], 500);
        }

        // Diccionario para buscar criptomonedas
        $cryptoMap = [
            'bitcoin' => 'BTC',
            'ethereum' => 'ETH',
            'binance' => 'BNB',
            'solana' => 'SOL',
            'cardano' => 'ADA',
            'doge' => 'DOGE',
            'monero' => 'XMR',
        ];

        // Identificar si 'from' o 'to' es una criptomoneda
        $fromIsCrypto = isset($cryptoMap[$from]);
        $toIsCrypto = isset($cryptoMap[$to]);

        // Obtener el precio en USD de 'from' y 'to'
        $fromPrice = $fromIsCrypto ? $this->getCryptoPrice($cryptos, $cryptoMap[$from]) : $fiatRates[$from] ?? null;
        $toPrice = $toIsCrypto ? $this->getCryptoPrice($cryptos, $cryptoMap[$to]) : $fiatRates[$to] ?? null;

        // Validar que ambos valores sean numéricos
        if (!is_numeric($fromPrice) || !is_numeric($toPrice)) {
            return response()->json([
                'error' => 'Moneda no soportada o datos no disponibles',
                'details' => [
                    'fromPrice' => $fromPrice,
                    'toPrice' => $toPrice,
                ],
            ], 400);
        }

        // Calcular la tasa de conversión
        $conversionRate = $fromPrice / $toPrice;

        return response()->json([
            'from' => $from,
            'to' => $to,
            'rate' => $conversionRate,
        ]);
    }


    /**
     * Obtiene las tasas de cambio dólar-euro desde Dinero.today
     */
    private function getFiatRates()
    {
        $response = Http::get($this->dineroTodayApi);

        if ($response->failed()) {
            return null;
        }

        $data = $response->json();

        // Depurar el resultado para verificar la estructura de la API
        if (empty($data['rates']['EUR'])) {
            return null; // No hay datos disponibles
        }

        return [
            'dolar' => 1, // USD es la base
            'euro' => $data['rates']['EUR'],
        ];
    }


    /**
     * Obtiene los precios de las criptomonedas desde CoinLore
     */
    private function getCryptoPrices()
    {
        $response = Http::get($this->coinLoreApi);

        if ($response->failed()) {
            return null;
        }

        $data = $response->json()['data'];

        // Depurar el resultado para asegurar que la estructura es correcta
        if (empty($data)) {
            return null; // No se encontraron datos
        }

        return $data;
    }


    /**
     * Obtiene el precio en USD de una criptomoneda específica
     */
    private function getCryptoPrice($cryptos, $symbol)
    {
        foreach ($cryptos as $crypto) {
            if ($crypto['symbol'] === $symbol) {
                return $crypto['price_usd'];
            }
        }

        return null;
    }
}
