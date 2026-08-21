<?php

namespace Database\Factories;

use App\Models\Accelerograph;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accelerograph>
 */
class AccelerographFactory extends Factory
{
    protected $model = Accelerograph::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $siteCodes = [
            'AC-BKB01', 'AC-BKB02', 'AC-SMD01', 'AC-SMD02', 'AC-BRU01',
            'AC-TRK01', 'AC-TRK02', 'AC-KUT01', 'AC-KUB01', 'AC-PSR01',
            'AC-PPU01', 'AC-BTG01', 'AC-MLN01', 'AC-NNK01', 'AC-TJS01',
        ];

        $lokasiList = [
            'Kantor Walikota Balikpapan',
            'Bandara Sultan Aji Muhammad Sulaiman Sepinggan',
            'Kantor Gubernur Kalimantan Timur, Samarinda',
            'Universitas Mulawarman, Samarinda',
            'Kantor Bupati Berau, Tanjung Redeb',
            'Bandara Juwata, Tarakan',
            'Kantor Walikota Tarakan',
            'Kantor Bupati Kutai Kartanegara, Tenggarong',
            'Kantor Bupati Kutai Barat, Sendawar',
            'Kantor Bupati Paser, Tanah Grogot',
            'Kantor Bupati Penajam Paser Utara',
            'Kantor Walikota Bontang',
            'Kantor Bupati Malinau',
            'Kantor Bupati Nunukan',
            'Kantor Bupati Bulungan, Tanjung Selor',
        ];

        $merks = [
            'Nanometrics',
            'Kinemetrics',
            'Guralp Systems',
            'GeoSIG',
            'Tokyo Sokushin',
            'Syscom Instruments',
        ];

        $tipeAccelerometers = [
            'Titan Strong Motion Accelerometer',
            'Episensor FBA ES-T',
            'CMG-5T Force Balance Accelerometer',
            'AC-73 Triaxial Accelerometer',
            'CV-374 Triaxial Servo Accelerometer',
            'MR3000C Integrated Seismic Sensor',
        ];

        $digitizers = [
            'Nanometrics Centaur 24-bit',
            'Kinemetrics Basalt 24-bit Recorder',
            'Kinemetrics Rock Strong Motion Recorder',
            'Guralp DM24 MK3',
            'GeoSIG GMSplus Seismic Recorder',
            'Tokyo Sokushin SAMTAC-802',
        ];

        return [
            'nama' => $this->faker->unique()->randomElement($siteCodes).' - '.$this->faker->streetName(),
            'lokasi' => $this->faker->randomElement($lokasiList),
            'latitude' => (string) $this->faker->randomFloat(6, -4.5, 4.0),
            'longitude' => (string) $this->faker->randomFloat(6, 114.0, 119.5),
            'merk' => $this->faker->randomElement($merks),
            'tipe_accelerometer' => $this->faker->randomElement($tipeAccelerometers),
            'digitizer' => $this->faker->randomElement($digitizers),
        ];
    }
}
