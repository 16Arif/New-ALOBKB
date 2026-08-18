<?php

namespace Database\Seeders;

use App\Models\LightningDetector;
use Illuminate\Database\Seeder;

class LightningDetectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialData = [
            [
                'nama_site' => 'LD-BKB01 - Stageof Balikpapan',
                'lokasi' => 'Stasiun Geofisika Balikpapan, Jl. Mulawarman No. 2',
                'latitude' => '-1.265380',
                'longitude' => '116.831200',
                'sensor' => 'Vaisala TLS200 Total Lightning Sensor',
                'receiver' => 'Vaisala CP2000 Central Processor',
            ],
            [
                'nama_site' => 'LD-SMD01 - Stamet Samarinda',
                'lokasi' => 'Stasiun Meteorologi APT Pranoto Samarinda',
                'latitude' => '-0.385400',
                'longitude' => '117.251200',
                'sensor' => 'Vaisala LS7002 Lightning Sensor',
                'receiver' => 'Vaisala TLP100 Lightning Processor',
            ],
            [
                'nama_site' => 'LD-BRU01 - Stamet Berau',
                'lokasi' => 'Stasiun Meteorologi Kalimarau, Berau',
                'latitude' => '2.155400',
                'longitude' => '117.433800',
                'sensor' => 'Boltek EFM-100 Electric Field Monitor',
                'receiver' => 'Boltek StormTracker PCI Receiver',
            ],
            [
                'nama_site' => 'LD-TRK01 - Stamet Tarakan',
                'lokasi' => 'Stasiun Meteorologi Juwata Tarakan',
                'latitude' => '3.327500',
                'longitude' => '117.568300',
                'sensor' => 'Vaisala TLS200 Total Lightning Sensor',
                'receiver' => 'Vaisala CP2000 Central Processor',
            ],
            [
                'nama_site' => 'LD-PSR01 - Tanah Grogot',
                'lokasi' => 'Pos Meteorologi Tanah Grogot, Kabupaten Paser',
                'latitude' => '-1.898200',
                'longitude' => '116.141500',
                'sensor' => 'NexStorm ANT-1 Directional Antenna',
                'receiver' => 'NexStorm Lightning Processing Server',
            ],
        ];

        foreach ($initialData as $data) {
            LightningDetector::firstOrCreate(
                ['nama_site' => $data['nama_site']],
                $data
            );
        }

        // Additional dummy data via Factory
        LightningDetector::factory()->count(10)->create();
    }
}
