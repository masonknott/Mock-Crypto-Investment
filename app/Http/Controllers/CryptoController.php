<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Cryptocurrency;
class CryptoController extends Controller
{
    public function index()
    {
        $apiCryptos = $this->fetchLiveCryptocurrencyData();

        if(!is_array($apiCryptos)){
            $apiCryptos =[];
        }
        foreach ($apiCryptos as $crypto){
            Cryptocurrency::updateOrCreate(
                ['symbol' =>$crypto['symbol']],
                ['name'=>$crypto['name'], 'price' =>$crypto['quote']['usd']['price']]
            );
        }
        $cryptos = Cryptocurrency::all();
        return view('cryptos.index', compact('cryptos')
    );
}

    public function fetchLiveCryptocurrencyData()
    {
        $apiKey = env('COINMARKETCAP_API_KEY');
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $apiKey,
            'Accept' => 'application/json',
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'start' => '1',
            'limit' => '10',
            'convert' => 'USD',
        ]);
        if ($response->successful()) {
            $cryptos = $response->json()['data'];
        } else {
            \Log::error("API call to CoinMarketCap failed: " . $response->body());
            $cryptos = [];
            return [];
        }
    }
}
