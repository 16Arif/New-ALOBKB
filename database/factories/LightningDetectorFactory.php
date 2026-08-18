<?php

namespace Database\Factories;

use App\Models\LightningDetector;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LightningDetector>
 */
class LightningDetectorFactory extends Factory
{
    protected $model = LightningDetector::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $siteCodes = [
            'LD-BKB01', 'LD-BKB02', 'LD-SMD01', 'LD-BRU01', 'LD-TRK01',
            'LD-PSR01', 'LD-PPU01', 'LD-KUT01', 'LD-KUB01', 'LD-BTG01',
            'LD-MLN01', 'LD-NNK01', 'LD-TJS01', 'LD-SGT01',
        ];

        $lokasiList = [
            'Stasiun Geofisika Balikpapan',
            'Stasiun Meteorologi Sepinggan Balikpapan',
            'Stasiun Meteorologi Temindung Samarinda',
            'Stasiun Meteorologi Kalimarau Berau',
            'Stasiun Meteorologi Juwata Tarakan',
            'Kantor BMKG Tanah Grogot, Paser',
            'Kantor BMKG Penajam Paser Utara',
            'Pos Pengamatan Hilir Tenggarong, Kutai Kartanegara',
            'Stasiun Meteorologi Sendawar, Kutai Barat',
            'Stasiun Meteorologi Bontang',
            'Stasiun Meteorologi Malinau',
            'Stasiun Meteorologi Nunukan',
            'Stasiun Meteorologi Tanjung Harapan, Tanjung Selor',
            'Pos Hujan Sangatta, Kutai Timur',
        ];

        $sensors = [
            'Vaisala TLS200 Total Lightning Sensor',
            'Vaisala LS7002 Lightning Sensor',
            'Boltek EFM-100 Electric Field Monitor',
            'NexStorm ANT-1 Directional Antenna',
            'Earth Networks Total Lightning Sensor (ENTLS)',
            'TOA Systems Lightning Sensor',
        ];

        $receivers = [
            'Vaisala CP2000 Central Processor',
            'Vaisala TLP100 Lightning Processor',
            'Boltek StormTracker PCI Receiver',
            'NexStorm Lightning Processing Server',
            'Earth Networks Integrated Data Logger',
            'LS7000 Central Processing Unit',
        ];

        return [
            'nama_site' => $this->faker->unique()->randomElement($siteCodes).' - '.$this->faker->streetName(),
            'lokasi' => $this->faker->randomElement($lokasiList),
            'latitude' => (string) $this->faker->randomFloat(6, -4.5, 4.0),
            'longitude' => (string) $this->faker->randomFloat(6, 114.0, 119.5),
            'sensor' => $this->faker->randomElement($sensors),
            'receiver' => $this->faker->randomElement($receivers),
        ];
    }
}
