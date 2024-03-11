<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cryptocurrency;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Cryptocurrency::create([
            'name'=>'Bitcoin',
            'symbol'=> 'BTC',
            'price' => 20000.00,
        ]);
    }
}
