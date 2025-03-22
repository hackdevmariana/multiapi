<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CryptoExchangeController extends Controller
{
    private $coinGeckoApi = 'https://api.coingecko.com/api/v3/simple/price';
    private $dineroTodayApi = 'https://cdn.dinero.today/api/latest.json';

    /**
     * Convierte entre criptomonedas y monedas fiat (euro, dólar)
     */
    public function getExchange($from, $to)
    {
        // Mapear monedas fiat
        $fiatMap = [
            'dolar' => 'usd',
            'euro' => 'eur',
        ];

        // Obtener el tipo de cambio dólar-euro desde Dinero.today
        $fiatRates = $this->getFiatRates();

        if (!$fiatRates) {
            return response()->json(['error' => 'No se pudo obtener las tasas de cambio de Dinero.today'], 500);
        }

        // Diccionario para buscar criptomonedas en CoinGecko
        $cryptoMap = [
            'bitcoin' => 'bitcoin',
            'ethereum' => 'ethereum',
            'binance' => 'binancecoin',
            'solana' => 'solana',
            'cardano' => 'cardano',
            'doge' => 'dogecoin',
            'monero' => 'monero',
        ];

        // Identificar si 'from' o 'to' es una criptomoneda o una moneda fiat
        $fromIsCrypto = isset($cryptoMap[$from]);
        $toIsCrypto = isset($cryptoMap[$to]);

        // Mapear las monedas fiat
        $from = !$fromIsCrypto && isset($fiatMap[$from]) ? $fiatMap[$from] : $from;
        $to = !$toIsCrypto && isset($fiatMap[$to]) ? $fiatMap[$to] : $to;

        // Obtener el precio en USD de 'from' y 'to'
        $fromPrice = $fromIsCrypto ? $this->getCryptoPrice($cryptoMap[$from], $toIsCrypto ? 'usd' : $to) : $fiatRates[$from] ?? null;
        $toPrice = $toIsCrypto ? $this->getCryptoPrice($cryptoMap[$to], $fromIsCrypto ? 'usd' : $from) : $fiatRates[$to] ?? null;

        // Validar que ambos valores sean numéricos
        if ($fromPrice === null || $toPrice === null) {
            return response()->json([
                'error' => 'Moneda no soportada o datos no disponibles',
                'details' => [
                    'from' => $from,
                    'to' => $to,
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

        // Validar que la estructura de los datos sea correcta
        if (empty($data['rates']['EUR']) || !is_numeric($data['rates']['EUR'])) {
            return null; // No hay datos disponibles
        }

        return [
            'usd' => 1, // USD es la base
            'eur' => (float) $data['rates']['EUR'], // Convertir a flotante
        ];
    }


    /**
     * Obtiene el precio de una criptomoneda específica desde CoinGecko
     */
    private function getCryptoPrice($crypto, $currency)
    {
        // Realizamos la solicitud a CoinGecko
        $response = Http::get($this->coinGeckoApi, [
            'ids' => $crypto,
            'vs_currencies' => $currency,
        ]);

        // Depuración si la API falla
        if ($response->failed()) {
            dd('Error en la solicitud a CoinGecko:', $crypto, $currency, $response->json());
        }

        $data = $response->json();

        // Depuración si la respuesta está vacía o no tiene los datos esperados
        if (empty($data) || !isset($data[$crypto][$currency])) {
            dd('Datos no encontrados en CoinGecko:', $crypto, $currency, $data);
        }

        // Extraer el precio
        return $data[$crypto][$currency];
    }
}
