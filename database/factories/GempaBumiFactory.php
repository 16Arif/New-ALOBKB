<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GempaBumi>
 */
class GempaBumiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    // Ambil waktu random di zona WIB
    $localWIB = Carbon::createFromTimeString($this->faker->time())->setTimezone('Asia/Jakarta');

    // Copy dan ubah ke UTC dan WITA
    $utcTime = $localWIB->copy()->setTimezone('UTC');
    $localWITA = $localWIB->copy()->setTimezone('Asia/Makassar');

    return [
        'tanggal' => $this->faker->date(),
        'waktu' => $localWIB->format('H:i:s'),        // WIB
        'waktu_utc' => $utcTime->format('H:i:s'),     // UTC dari WIB
        'waktu_wita' => $localWITA->format('H:i:s'),  // WITA
        'lintang' => $this->faker->randomElement(['0.2','0.5','-0.2','-1.0']),
        'bujur' => $this->faker->randomElement(['114.2','113.5','112.2','115.0']),
        'magnitudo' => $this->faker->randomElement(['4.2','3.5','2.2','5.0']),
        'kedalaman' => $this->faker->randomElement(['20','30','80','10']),
        'jarak' => $this->faker->randomElement([
            '11km Timur Bontang',
            '15km Timur laut Sangatta',
            '11km Barat Batu licin',
            '20km Timur Berau'
        ]),
        'dirasakan' => $this->faker->randomElement(['DIRASAKAN','TIDAK DIRASAKAN']),
        'keterangan' => $this->faker->text(),
    ];
}

}
