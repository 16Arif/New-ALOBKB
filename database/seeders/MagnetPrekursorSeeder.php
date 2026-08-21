<?php

namespace Database\Seeders;

use App\Models\MagnetPrekursor;
use Illuminate\Database\Seeder;

class MagnetPrekursorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialData = [
            [
                'nama_site' => 'MP-BKB01 - Stageof Balikpapan',
                'lokasi' => 'Taman Alat Geomagnetik Stasiun Geofisika Balikpapan',
                'latitude' => '-1.265380',
                'longitude' => '116.831200',
                'tahun_instalasi' => '2018',
                'sensor' => 'Fluxgate Magnetometer 3-Axis',
                'digitizer' => 'LEMI-417 High Resolution Data Logger',
                'regulator' => 'Morningstar SunSaver 10A Solar Controller',
            ],
            [
                'nama_site' => 'MP-SMD01 - Samarinda',
                'lokasi' => 'Stasiun Meteorologi APT Pranoto Samarinda',
                'latitude' => '-0.385400',
                'longitude' => '117.251200',
                'tahun_instalasi' => '2020',
                'sensor' => 'Overhauser GSM-19 Magnetometer',
                'digitizer' => 'Magrec-4B Geomagnetic Data Recorder',
                'regulator' => 'Victron BlueSolar PWM-Pro 12V/24V',
            ],
            [
                'nama_site' => 'MP-BRU01 - Berau',
                'lokasi' => 'Stasiun Meteorologi Kalimarau, Berau',
                'latitude' => '2.155400',
                'longitude' => '117.433800',
                'tahun_instalasi' => '2021',
                'sensor' => 'LEMI-018 High Resolution Magnetometer',
                'digitizer' => 'LEMI-417 High Resolution Data Logger',
                'regulator' => 'Morningstar SunSaver 10A Solar Controller',
            ],
            [
                'nama_site' => 'MP-TRK01 - Tarakan',
                'lokasi' => 'Stasiun Meteorologi Juwata Tarakan',
                'latitude' => '3.327500',
                'longitude' => '117.568300',
                'tahun_instalasi' => '2019',
                'sensor' => 'Bartington Mag-03MS100 Three-Axis Sensor',
                'digitizer' => 'Mini-GeoLog 24-bit Logger',
                'regulator' => 'Steca Solsum 8.8F Charge Controller',
            ],
            [
                'nama_site' => 'MP-PSR01 - Paser',
                'lokasi' => 'Pos Pengamatan Geofisika Tanah Grogot, Paser',
                'latitude' => '-1.898200',
                'longitude' => '116.141500',
                'tahun_instalasi' => '2022',
                'sensor' => 'Fluxgate Magnetometer 3-Axis',
                'digitizer' => 'Magrec-4B Geomagnetic Data Recorder',
                'regulator' => 'Victron BlueSolar PWM-Pro 12V/24V',
            ],
        ];

        foreach ($initialData as $data) {
            MagnetPrekursor::firstOrCreate(
                ['nama_site' => $data['nama_site']],
                $data
            );
        }

        // Generate 2 additional dummy records via Factory
        MagnetPrekursor::factory()->count(2)->create();
    }
}
