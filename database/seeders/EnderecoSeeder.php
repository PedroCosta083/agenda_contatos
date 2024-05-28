<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enderecos')->insert([
            'cep' => '49030-323',
            'logradouro' => 'Rua José da Amarante',
            'numero' => '77',
            'cidade' => 'Aracaju',
            'contato_id' => 1,
        ]);
    }
}
