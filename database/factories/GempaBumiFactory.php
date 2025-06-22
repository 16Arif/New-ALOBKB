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
        $localTime = Carbon::createFromTimeString($this->faker->time(), 'Asia/Makassar');
        return [
            'tanggal' =>$this->faker->date(),
            'waktu' => $localTime->format('H:i:s'),
            'waktuUtc' => $localTime->copy()->setTimezone('UTC')->format('H:i:s'),
            'magnitudo' =>$this->faker->randomElement(['4.2','3.5','2.2','5.0']),
            'lintang' =>$this->faker->randomElement(['0.2','0.5','0.2','1.0']),
            'bujur' =>$this->faker->randomElement(['114.2','113.5','112.2','115.0']),
            'jarak' =>$this->faker->randomElement(['11km Timur Bontang','15km Timur laut Sangatta','11km Barat Batu licin','20km Timur Berau']),
            'kedalaman' =>$this->faker->randomElement(['20km','30km','80km','10km']),
            'dirasakan' =>$this->faker->randomElement(['Ya','Tidak']),
            'keterangan' =>$this->faker->text(),
        ];
    }
}
