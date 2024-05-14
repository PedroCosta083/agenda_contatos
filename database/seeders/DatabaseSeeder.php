<?php

namespace Database\Seeders;

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
        $this->call(
            array(
                ContatoSeeder::class,
                EnderecoSeeder::class,
                TelefoneSeeder::class,
                TipoTelefoneSeeder::class,
                CategoriaSeeder::class,
                ContatoHasCategoriaSeeder::class,
            )
        );
    }
}
