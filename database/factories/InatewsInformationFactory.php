<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InatewsInformation>
 */
class InatewsInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lat' => $this->faker->latitude(),
            'long' => $this->faker->longitude(),
            'elevasi' => $this->faker->randomNumber(2),
            'th_install' => $this->faker->date('Y-m-d'),
            'alamat_site' => $this->faker->address(),
            'kel_site' => $this->faker->streetName(),
            'kec_site' => $this->faker->streetName(),
            'kota' => $this->faker->city(),
            'prov' => $this->faker->state(),
            'pic_site' => $this->faker->name(),
            'kontak_pic' => $this->faker->phoneNumber(),
            'upt' => $this->faker->streetName(),
            'alamat_upt' => $this->faker->address(),
            'kel_upt' => $this->faker->streetName(),
            'kec_upt' => $this->faker->streetName(),
            'kota_upt' => $this->faker->city(),
            'jab_pic_upt' => 'Kepala Stasiun',
            'pic_upt' => $this->faker->name(),
            'kontak_pic_upt' => $this->faker->phoneNumber()
        ];
    }
}
