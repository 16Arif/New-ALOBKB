<?php

namespace Database\Seeders;

use App\Models\LogbookPeralatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogbookPeralatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LogbookPeralatan::factory(10)->create();
    }
}
