<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AnolectoActivoTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(MesesTableSeeder::class);
        $this->call(PrecosTableSeeder::class);
        $this->call(ProvinciasTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);
    }
}
