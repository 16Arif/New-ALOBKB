<?php

namespace Database\Seeders;

use App\Models\LogbookGempa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogbookGempaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LogbookGempa::factory(10)->create();
    }
}
