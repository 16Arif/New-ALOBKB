<?php

namespace Database\Seeders;

use App\Models\Seismograph;
use Illuminate\Database\Seeder;

class SeismographSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialData = [
            [
                'nama_site' => 'BBKI - Balikpapan',
                'lokasi' => 'Stasiun Geofisika Balikpapan, Jl. Mulawarman, Balikpapan',
                'latitude' => '-1.265380',
                'longitude' => '116.831200',
                'seismometer' => 'Nanometrics Trillium Compact 120s',
                'accelerometer' => 'Nanometrics Titan Accelerometer',
                'digitizer' => 'Nanometrics Centaur 24-bit',
            ],
            [
                'nama_site' => 'SBKI - Samarinda',
                'lokasi' => 'Stasiun Meteorologi Temindung, Samarinda',
                'latitude' => '-0.494800',
                'longitude' => '117.158300',
                'seismometer' => 'Guralp CMG-3T Broadband',
                'accelerometer' => 'Guralp CMG-5T Strong Motion',
                'digitizer' => 'Guralp DM24 MK3',
            ],
            [
                'nama_site' => 'TGKI - Tanjung Redeb',
                'lokasi' => 'Stasiun Meteorologi Kalimarau, Berau',
                'latitude' => '2.155400',
                'longitude' => '117.433800',
                'seismometer' => 'Nanometrics Trillium 120PA',
                'accelerometer' => 'Kinemetrics Episensor',
                'digitizer' => 'Nanometrics Centaur 24-bit',
            ],
            [
                'nama_site' => 'TRKI - Tarakan',
                'lokasi' => 'Stasiun Meteorologi Juwata, Tarakan',
                'latitude' => '3.327500',
                'longitude' => '117.568300',
                'seismometer' => 'Geotech KS-2000',
                'accelerometer' => 'Nanometrics Titan Accelerometer',
                'digitizer' => 'Quanterra Q330HR',
            ],
            [
                'nama_site' => 'SWI - Sangatta',
                'lokasi' => 'Sangatta, Kutai Timur',
                'latitude' => '0.518600',
                'longitude' => '117.581400',
                'seismometer' => 'Nanometrics Trillium Compact 120s',
                'accelerometer' => 'Nanometrics Titan Accelerometer',
                'digitizer' => 'Nanometrics Taurus Portable',
            ],
        ];

        foreach ($initialData as $data) {
            Seismograph::firstOrCreate(
                ['nama_site' => $data['nama_site']],
                $data
            );
        }

        // Additional dummy data via Factory
        Seismograph::factory()->count(10)->create();
    }
}
