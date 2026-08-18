<?php

namespace Database\Factories;

use App\Models\MagnetPrekursor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MagnetPrekursor>
 */
class MagnetPrekursorFactory extends Factory
{
    protected $model = MagnetPrekursor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $siteCodes = [
            'MP-BKB01', 'MP-SMD01', 'MP-BRU01', 'MP-TRK01', 'MP-PSR01',
            'MP-PPU01', 'MP-KUT01', 'MP-BTG01', 'MP-TJS01',
        ];

        $lokasiList = [
            'Stasiun Geofisika Balikpapan (Taman Alat Geomagnet)',
            'Stasiun Meteorologi Temindung Samarinda',
            'Stasiun Meteorologi Kalimarau Berau',
            'Stasiun Meteorologi Juwata Tarakan',
            'Pos Pengamatan Paser, Tanah Grogot',
            'Pos Pengamatan Penajam Paser Utara',
            'Stasiun Meteorologi Bontang',
        ];

        $sensors = [
            'Fluxgate Magnetometer 3-Axis',
            'Overhauser GSM-19 Magnetometer',
            'LEMI-018 High Resolution Magnetometer',
            'Bartington Mag-03MS100 Three-Axis Sensor',
            'Geomagnetic Precursor Fluxgate Sensor',
        ];

        $digitizers = [
            'LEMI-417 High Resolution Data Logger',
            'Magrec-4B Geomagnetic Data Recorder',
            'Mini-GeoLog 24-bit Logger',
            'SAMTAC-802 Magnet Acquisition System',
        ];

        $regulators = [
            'Morningstar SunSaver 10A Solar Controller',
            'Victron BlueSolar PWM-Pro 12V/24V',
            'Steca Solsum 8.8F Charge Controller',
            'Meanwell PB-360 Series Power Regulator',
            'EPSolar LandStar PWM Solar Regulator',
        ];

        return [
            'nama_site' => $this->faker->unique()->randomElement($siteCodes).' - '.$this->faker->streetName(),
            'lokasi' => $this->faker->randomElement($lokasiList),
            'latitude' => (string) $this->faker->randomFloat(6, -4.5, 4.0),
            'longitude' => (string) $this->faker->randomFloat(6, 114.0, 119.5),
            'tahun_instalasi' => (string) $this->faker->numberBetween(2015, 2024),
            'sensor' => $this->faker->randomElement($sensors),
            'digitizer' => $this->faker->randomElement($digitizers),
            'regulator' => $this->faker->randomElement($regulators),
        ];
    }
}
