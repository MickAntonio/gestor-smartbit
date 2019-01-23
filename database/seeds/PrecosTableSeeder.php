<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrecosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('precos')->insert([
            ['preco' => 0, 'moeda' => 'KZ'],
            ['preco' => 50, 'moeda' => 'KZ'],
            ['preco' => 100, 'moeda' => 'KZ'],
            ['preco' => 200, 'moeda' => 'KZ'],
            ['preco' => 300, 'moeda' => 'KZ'],
            ['preco' => 400, 'moeda' => 'KZ'],
            ['preco' => 500, 'moeda' => 'KZ'],
            ['preco' => 600, 'moeda' => 'KZ'],
            ['preco' => 700, 'moeda' => 'KZ'],
            ['preco' => 800, 'moeda' => 'KZ'],
            ['preco' => 900, 'moeda' => 'KZ'],
            ['preco' => 1000, 'moeda' => 'KZ'],
            ['preco' => 1500, 'moeda' => 'KZ'],
            ['preco' => 2000, 'moeda' => 'KZ'],
            ['preco' => 2500, 'moeda' => 'KZ'],
            ['preco' => 3500, 'moeda' => 'KZ'],
            ['preco' => 3000, 'moeda' => 'KZ'],
            ['preco' => 10000, 'moeda' => 'KZ'],
            ['preco' => 11000, 'moeda' => 'KZ'],
            ['preco' => 12000, 'moeda' => 'KZ'],
            ['preco' => 13000, 'moeda' => 'KZ'],
            ['preco' => 15000, 'moeda' => 'KZ'],
            ['preco' => 20000, 'moeda' => 'KZ'],
            ['preco' => 70000, 'moeda' => 'KZ']
        ]);
    }
}
