<?php

namespace Database\Seeders;

use App\Models\LogbookPetir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogbookpetirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LogbookPetir::factory(40)->create();
    }
}
