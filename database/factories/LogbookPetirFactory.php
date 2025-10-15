<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogbookPetir>
 */
class LogbookpetirFactory extends Factory
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
            'onduty1' => $this->faker->name(),
            'onduty2' => $this->faker->name(),
            'onduty3' => $this->faker->name(),
            'onduty4' => $this->faker->name(),
            'onduty5' => $this->faker->name(),
            'pengamatan1' => $this->faker->randomElement(['Pengamatan LD jam 02.00', 'Pengamatan LD jam 08.00', 'Pengamatan LD jam 14.00', 'Pengamatan LD jam 20.00']),
            'pengamatan2' => $this->faker->randomElement(['Pengamatan LD jam 03.00', 'Pengamatan LD jam 09.00', 'Pengamatan LD jam 15.00', 'Pengamatan LD jam 21.00']),
            'pengamatan3' => $this->faker->randomElement(['Pengamatan LD jam 04.00', 'Pengamatan LD jam 10.00', 'Pengamatan LD jam 16.00', 'Pengamatan LD jam 22.00']),
            'pengamatan4' => $this->faker->randomElement(['Pengamatan LD jam 05.00', 'Pengamatan LD jam 11.00', 'Pengamatan LD jam 17.00', 'Pengamatan LD jam 23.00']),
            'pengamatan5' => $this->faker->randomElement(['Pengamatan LD jam 06.00', 'Pengamatan LD jam 12.00', 'Pengamatan LD jam 18.00', 'Pengamatan LD jam 00.00']),
            'pengamatan6' => $this->faker->randomElement(['Pengamatan LD jam 07.00', 'Pengamatan LD jam 13.00', 'Pengamatan LD jam 19.00', 'Pengamatan LD jam 01.00']),
            'pengamatan7' => $this->faker->randomElement(['Pengamatan LD jam 08.00', 'Pengamatan LD jam 14.00', 'Pengamatan LD jam 20.00', 'Pengamatan LD jam 02.00']),
            'kondisi' => 'BAIK',
            'note' => $this->faker->text(),

        ];
    }
}
