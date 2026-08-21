<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProvinsiBorderSeeder::class,
            KabKotaBorderSeeder::class,
            GempaBumiSeeder::class,
            LogbookGempaSeeder::class,
            LogbookPetirSeeder::class,
            LogbookPeralatanSeeder::class,
            SeismographSeeder::class,
            AccelerographSeeder::class,
            LightningDetectorSeeder::class,
            WrsNgSeeder::class,
            MagnetPrekursorSeeder::class,
        ]);

    }
}
