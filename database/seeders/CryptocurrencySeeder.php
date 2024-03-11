<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cryptocurrency;

class CryptocurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cryptocurrency::create([
            'name' => 'bitcoin',
            'symbol'=> 'BTC',
            'price'=> 20000,
        ]);
    }
}
