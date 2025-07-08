<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InatewsEquipment>
 */
class InatewsEquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manufaktur_seismo' => $this->faker->firstName(),
            'tipe_seismo' => $this->faker->name(),
            'sn_seismo' => $this->faker->randomNumber(6),
            'tanggalinstall_seismo' => $this->faker->date('d-M-Y'),
        ];
    }
}
