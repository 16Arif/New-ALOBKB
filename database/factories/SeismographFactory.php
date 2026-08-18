<?php

namespace Database\Factories;

use App\Models\Seismograph;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seismograph>
 */
class SeismographFactory extends Factory
{
    protected $model = Seismograph::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $siteCodes = ['BBKI', 'BKB', 'SBKI', 'TGKI', 'SWI', 'SKKI', 'TJBI', 'KHKI', 'DBKI', 'SANI', 'TRKI', 'MNKI', 'PLKI', 'SNKI'];
        $lokasiList = [
            'Stasiun Geofisika Balikpapan',
            'Samarinda Seismograph Station',
            'Berau Seismograph Station',
            'Tarakan Geophysics Station',
            'Tanjung Selor Site',
            'Nunukan Border Station',
            'Paser Seismic Station',
            'Penajam Paser Utara Station',
            'Kutai Kartanegara Station',
            'Kutai Barat Site',
            'Mahakam Ulu Station',
            'Bontang Seismic Site',
            'Sangatta East Kutai',
            'Malinau North Kalimantan',
        ];
        $seismometers = [
            'Nanometrics Trillium Compact 120s',
            'Nanometrics Trillium 120PA',
            'Guralp CMG-3T Broadband',
            'Guralp CMG-40T',
            'Geotech KS-2000',
            'Streckeisen STS-2',
        ];
        $accelerometers = [
            'Nanometrics Titan Accelerometer',
            'Guralp CMG-5T Strong Motion',
            'Kinemetrics Episensor',
            'Syscom MR3000C',
        ];
        $digitizers = [
            'Nanometrics Centaur 24-bit',
            'Nanometrics Taurus Portable',
            'Guralp DM24 MK3',
            'Quanterra Q330HR',
            'Kinemetrics Q330',
        ];

        return [
            'nama_site' => $this->faker->unique()->randomElement($siteCodes).' - '.$this->faker->city(),
            'lokasi' => $this->faker->randomElement($lokasiList),
            'latitude' => (string) $this->faker->randomFloat(6, -4.5, 4.0),
            'longitude' => (string) $this->faker->randomFloat(6, 114.0, 119.5),
            'seismometer' => $this->faker->randomElement($seismometers),
            'accelerometer' => $this->faker->randomElement($accelerometers),
            'digitizer' => $this->faker->randomElement($digitizers),
        ];
    }
}
