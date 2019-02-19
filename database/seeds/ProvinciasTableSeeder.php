<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provincias')->insert([
            ['nome' => 'Bengo'],
            ['nome' => 'Benguela'],
            ['nome' => 'Bié'],
            ['nome' => 'Cabinda'],
            ['nome' => 'Cuando-Cubango'],
            ['nome' => 'Kwanza Sul'],
            ['nome' => 'Kwanza Norte'],
            ['nome' => 'Cunene'],
            ['nome' => 'Huambo'],
            ['nome' => 'Huíla'],
            ['nome' => 'Luanda'],
            ['nome' => 'Lunda-Norte'],
            ['nome' => 'Lunda-Sul'],
            ['nome' => 'Malanje'],
            ['nome' => 'Moxico'],
            ['nome' => 'Namibe'],
            ['nome' => 'Uíge'],
            ['nome' => 'Zaire']
        ]);
    }
}
