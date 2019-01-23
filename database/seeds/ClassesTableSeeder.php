<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            ['nome' => '10ª Classe'],
            ['nome' => '11ª Classe'],
            ['nome' => '12ª Classe'],
            ['nome' => '13ª Classe']
        ]);
    }
}
