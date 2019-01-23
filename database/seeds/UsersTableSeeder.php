<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'type' => 'Secretaria',
                'name' => 'secretaria',
                'email' => 'secretaria@gmail.com',
                'password' => '$2y$10$gxXLQ5ZsPDjsv4Db7yj3CO1G1F8VfqUUB0.C2zJNNcYgPsb7v1L7W',
                'remember_token' => 'Jk4dnh6pzrbKdQMQHNc2f2ocU8Z6VSx6sRqp9LtqkPpoOVWrzlwY2WVtqT7W'
            ],
            [
                'type' => 'Cordenacao',
                'name' => 'cordenacao',
                'email' => 'cordenacao@gmail.com',
                'password' => '$2y$10$9uSU69B0.pQkuEogQg7VHe5cOWLGXfllXoKSKpSPgBNie4jSAsgR6',
                'remember_token' => 'Z9y23PLvWSc8g1jV4levL2qbJ4tKD4wC8HUdAfM8yqTT5VvvrYdvjhdQ6rm8'
            ],
            [
                'type' => 'Financeiro',
                'name' => 'financeiro',
                'email' => 'financeiro@gmail.com',
                'password' => '$2y$10$rfVdrKvmg8b9dDhYUt0umueQMj840M40lhM1FlHPxCl3cAqfo3l9q',
                'remember_token' => 'iC9XVi3IY9eErP1mr7rwDVeJIhrJXEjX7urx7eFFRzUUAEqfqZs8PJNj9fpN'
            ]
        ]);

    }
}
