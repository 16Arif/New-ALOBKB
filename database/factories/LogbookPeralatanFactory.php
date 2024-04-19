<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogbookPeralatan>
 */
class LogbookperalatanFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->date(),
            'jam' => $this->faker->randomElement(['07.00', '13.00', '19.00', '01.00']),
            'onduty1' => $this->faker->word(),
            'onduty2' => $this->faker->word(),
            'onduty3' => $this->faker->word(),
            'kehadiran' => $this->faker->randomElement(['HADIR','TIDAK HADIR']),
            'fingerprint' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'tds' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'nexstorm' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'obs_nexstorm' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'cmss' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'monitoring' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'acc' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'wrsng' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'integrasi_data' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'seiscomp4' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'pc_magnet' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'monitor_zoom' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'internet_ops' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'internet_lokal' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'bkb_server' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'penakar_hujan' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'radio_ssb' => $this->faker->randomElement(['BAIK','TIDAK BAIK','TIDAK AKTIF']),
            'note' => $this->faker->text(),
        ];
    }
}
