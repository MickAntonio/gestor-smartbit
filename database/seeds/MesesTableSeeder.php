<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meses')->insert([
            ['mes' => 'Janeiro'],
            ['mes' => 'Fevereiro'],
            ['mes' => 'Março'],
            ['mes' => 'Abríl'],
            ['mes' => 'Maío'],
            ['mes' => 'Junho'],
            ['mes' => 'Julho'],
            ['mes' => 'Agosto'],
            ['mes' => 'Setembro'],
            ['mes' => 'Outubro'],
            ['mes' => 'Novembro'],
            ['mes' => 'Dezembro']
        ]);
    }

}
