<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\LogbookgempaSeeder;
use Database\Seeders\LogbookpetirSeeder;
use Database\Seeders\LogbookperalatanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LogbookpetirSeeder::class,
            LogbookperalatanSeeder::class,
            LogbookgempaSeeder::class,
        ]);

    }
}
