<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("categorias")->insert([
            'titulo' => 'Amigos',
        ]);
        DB::table("categorias")->insert([
            'titulo' => 'Vizinhos',
        ]);
        DB::table("categorias")->insert([
            'titulo' => 'Parentes',
        ]);
    }
}
