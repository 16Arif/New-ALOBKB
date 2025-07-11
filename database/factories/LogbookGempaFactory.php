<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogbookGempa>
 */
class LogbookgempaFactory extends Factory
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
            'kegiatan1' => $this->faker->text(),
            'kegiatan2' => $this->faker->text(),
            'monitoring1' => $this->faker->randomElement(['Observasi Seiscomp4 jam 08.00-11.00 WITA', 'Observasi Seiscomp4 jam 14.00-17.00 WITA', 'Observasi Seiscomp4 jam 20.00-23.00 WITA', 'Observasi Seiscomp4 jam 02.00-05.00 WITA']),
            'berita1' => $this->faker->randomElement(['Kirim Berita CMSS jam 03.00 GMT', 'Kirim Berita CMSS jam 09.00 GMT', 'Kirim Berita CMSS jam 15.00 GMT', 'Kirim Berita CMSS jam 21.00 GMT']),
            'monitoring2' => $this->faker->randomElement(['Observasi Seiscomp4 jam 11.00-14.00 WITA', 'Observasi Seiscomp4 jam 17.00-20.00 WITA', 'Observasi Seiscomp4 jam 23.00-02.00 WITA', 'Observasi Seiscomp4 jam 05.00-08.00 WITA']),
            'berita2' => $this->faker->randomElement(['Kirim Berita CMSS jam 06.00 GMT', 'Kirim Berita CMSS jam 12.00 GMT', 'Kirim Berita CMSS jam 18.00 GMT', 'Kirim Berita CMSS jam 00.00 GMT']),
            'kondisi' => $this->faker->randomElement(['BAIK', 'TIDAK BAIK']),
            'note' => $this->faker->text(),
        ];
    }
}
