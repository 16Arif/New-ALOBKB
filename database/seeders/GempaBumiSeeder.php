<?php

namespace Database\Seeders;

use App\Models\GempaBumi;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GempaBumiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GempaBumi::factory(55)->create();
    }
}
