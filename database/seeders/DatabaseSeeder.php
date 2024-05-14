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
        // \App\Models\User::factory(10)->create();
        $this->call(
            array(
                ContatoSeeder::class,
            )
        );
        $this->call(
            array(
                EnderecoSeeder::class,
            )
        );
        $this->call(
            array(
                TelefoneSeeder::class,
            )
        );
        $this->call(
            array(
                TipoTelefoneSeeder::class,
            )
        );
        $this->call(
            array(
                CategoriaSeeder::class,
            )
        );
        $this->call(
            array(
                ContatoHasCategoriaSeeder::class,
            )
        );
    }
}
