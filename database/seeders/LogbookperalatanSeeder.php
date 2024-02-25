<?php

namespace Database\Seeders;

use App\Models\LogbookPeralatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogbookperalatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LogbookPeralatan::factory(40)->create();
    }
}
