<?php

namespace Database\Seeders;

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
            'name' => 'Psicólogo Teste',
            'email' => 'psicologia@teste.net.br',
            'password' => bcrypt('senhaForte'),
            'role' => 'psychologist'
        ]);
        DB::table('users')->insert([
            'name' => 'Paciente Teste',
            'email' => 'paciente@teste.net.br',
            'password' => bcrypt('senhaForte')
        ]);
    }
}
