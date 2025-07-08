<?php

namespace Database\Seeders;

use App\Models\InatewsInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InatewsInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InatewsInformation::factory(10)->create();
    }
}
