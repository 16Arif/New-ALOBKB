<?php

namespace Database\Seeders;

use App\Models\Accelerograph;
use Illuminate\Database\Seeder;

class AccelerographSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialData = [
            [
                'nama' => 'AC-BKB01 - Balikpapan Kota',
                'lokasi' => 'Gedung Kantor Walikota Balikpapan, Jl. Jend. Sudirman No. 1',
                'latitude' => '-1.270420',
                'longitude' => '116.828850',
                'merk' => 'Nanometrics',
                'tipe_accelerometer' => 'Titan Strong Motion Accelerometer',
                'digitizer' => 'Nanometrics Centaur 24-bit',
            ],
            [
                'nama' => 'AC-BKB02 - Sepinggan',
                'lokasi' => 'Bandara Sultan Aji Muhammad Sulaiman Sepinggan Balikpapan',
                'latitude' => '-1.268200',
                'longitude' => '116.894400',
                'merk' => 'Kinemetrics',
                'tipe_accelerometer' => 'Episensor FBA ES-T',
                'digitizer' => 'Kinemetrics Basalt 24-bit Recorder',
            ],
            [
                'nama' => 'AC-SMD01 - Samarinda Kota',
                'lokasi' => 'Kantor Gubernur Kalimantan Timur, Jl. Gajah Mada No. 2, Samarinda',
                'latitude' => '-0.502100',
                'longitude' => '117.143800',
                'merk' => 'Guralp Systems',
                'tipe_accelerometer' => 'CMG-5T Force Balance Accelerometer',
                'digitizer' => 'Guralp DM24 MK3',
            ],
            [
                'nama' => 'AC-BRU01 - Berau',
                'lokasi' => 'Kantor BPBD Kabupaten Berau, Tanjung Redeb',
                'latitude' => '2.148500',
                'longitude' => '117.498200',
                'merk' => 'GeoSIG',
                'tipe_accelerometer' => 'AC-73 Triaxial Accelerometer',
                'digitizer' => 'GeoSIG GMSplus Seismic Recorder',
            ],
            [
                'nama' => 'AC-TRK01 - Tarakan',
                'lokasi' => 'Stasiun Meteorologi Juwata Tarakan, Kalimantan Utara',
                'latitude' => '3.327500',
                'longitude' => '117.568300',
                'merk' => 'Tokyo Sokushin',
                'tipe_accelerometer' => 'CV-374 Triaxial Servo Accelerometer',
                'digitizer' => 'Tokyo Sokushin SAMTAC-802',
            ],
        ];

        foreach ($initialData as $data) {
            Accelerograph::firstOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }

        // Generate additional realistic dummy data via Factory
        Accelerograph::factory()->count(10)->create();
    }
}
