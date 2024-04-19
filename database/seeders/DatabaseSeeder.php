<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\LogbookGempaSeeder;
use Database\Seeders\LogbookPetirSeeder;
use Database\Seeders\LogbookPeralatanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LogbookGempaSeeder::class,
            LogbookPetirSeeder::class,
            LogbookPeralatanSeeder::class,
        ]);

    }
}
