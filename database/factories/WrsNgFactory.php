<?php

namespace Database\Factories;

use App\Models\WrsNg;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WrsNg>
 */
class WrsNgFactory extends Factory
{
    protected $model = WrsNg::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $siteCodes = [
            'WRS-BKB01', 'WRS-BKB02', 'WRS-SMD01', 'WRS-SMD02', 'WRS-BRU01',
            'WRS-TRK01', 'WRS-PSR01', 'WRS-PPU01', 'WRS-KUT01', 'WRS-KUB01',
            'WRS-BTG01', 'WRS-MLN01', 'WRS-NNK01', 'WRS-TJS01', 'WRS-SGT01',
        ];

        $lokasiList = [
            'Kantor BPBD Kota Balikpapan',
            'Kantor Walikota Balikpapan (Pusdalops)',
            'Kantor BPBD Provinsi Kalimantan Timur, Samarinda',
            'Kantor Basarnas Kaltim-Kaltara, Balikpapan',
            'Kantor BPBD Kabupaten Berau, Tanjung Redeb',
            'Kantor BPBD Kota Tarakan',
            'Kantor BPBD Kabupaten Paser, Tanah Grogot',
            'Kantor BPBD Kabupaten Penajam Paser Utara',
            'Kantor BPBD Kabupaten Kutai Kartanegara, Tenggarong',
            'Kantor BPBD Kabupaten Kutai Barat, Sendawar',
            'Kantor BPBD Kota Bontang',
            'Kantor BPBD Kabupaten Malinau',
            'Kantor BPBD Kabupaten Nunukan',
            'Kantor BPBD Kabupaten Bulungan, Tanjung Selor',
            'Kantor BPBD Kabupaten Kutai Timur, Sangatta',
        ];

        return [
            'nama_site' => $this->faker->unique()->randomElement($siteCodes).' - '.$this->faker->company(),
            'lokasi' => $this->faker->randomElement($lokasiList),
            'latitude' => (string) $this->faker->randomFloat(6, -4.5, 4.0),
            'longitude' => (string) $this->faker->randomFloat(6, 114.0, 119.5),
        ];
    }
}
