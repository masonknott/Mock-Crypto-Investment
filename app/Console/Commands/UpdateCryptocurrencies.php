<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cryptocurrency;
use Illuminate\Support\Facades\Http;

class UpdateCryptocurrencies extends Command
{
    protected $signature = 'update:cryptocurrencies';
    protected $description = 'Command description';
    
    public function handle()
    {
        $apikey = env('COINMARKETCAP_API_KEY');
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $apikey,
            'Accept' => 'application/json',
            ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'start' => '1',
            'limit' => '10',
            'convert' => 'USD',
            ]);

            if($response->successful()){
                $cryptos = $response->json()['data'];
                foreach ($cryptos as $crypto){
                    Cryptocurrency::updateOrCreate(
                        ['symbol' => $crypto['symbol']],
                        ['name' => $crypto['name'], 'price' => $crypto['quote']['USD']['price']]
                    );
                }
                $this->info('Cryptocurrency data updated successfully');
            }
            else
            {
                \Log::error('API call to coinmarketcap failed' . $response->body());
                $this->error('Failed to update crypto data');
            }
            }
}
