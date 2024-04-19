<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogbookPeralatan>
 */
class LogbookperalatanFactory extends Factory
{

    private const STATUS_OPTIONS = ['BAIK', 'TIDAK BAIK', 'TIDAK AKTIF'];
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
            'fingerprint' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'tds' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'nexstorm' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'obs_nexstorm' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'cmss' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'monitoring' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'acc' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'wrsng' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'integrasi_data' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'seiscomp4' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'pc_magnet' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'monitor_zoom' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'internet_ops' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'internet_lokal' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'bkb_server' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'penakar_hujan' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'radio_ssb' => $this->faker->randomElement([self::STATUS_OPTIONS]),
            'note' => $this->faker->text(),
        ];
    }
}
