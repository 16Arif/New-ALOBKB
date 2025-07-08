<?php

namespace Database\Seeders;

use App\Models\InatewsCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InatewsCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InatewsCode::factory(10)->create();
    }
}
