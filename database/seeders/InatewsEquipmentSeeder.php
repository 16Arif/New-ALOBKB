<?php

namespace Database\Seeders;

use App\Models\InatewsEquipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InatewsEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InatewsEquipment::factory(12)->create();
    }
}
