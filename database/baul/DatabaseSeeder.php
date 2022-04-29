<?php

namespace Database\Seeders;

use App\Models\Seu;
use App\Models\Usuari;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\Seu::factory(5)->create();
        \App\Models\Usuari::factory(10)->create();
    }
}
