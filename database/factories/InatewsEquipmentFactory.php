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
            'tglinstall_seismo' => $this->faker->date('d-M-Y'),
            'manufaktur_acc' => $this->faker->firstName(),
            'tipe_acc' => $this->faker->name(),
            'sn_acc' => $this->faker->randomNumber(6),
            'tglinstall_acc' => $this->faker->date('d-M-Y'),
            'manufaktur_digitizer' => $this->faker->firstName(),
            'tipe_digitizer' => $this->faker->name(),
            'sn_digitizer' => $this->faker->randomNumber(6),
            'tglinstall_digitizer' => $this->faker->date('d-M-Y'),
            'manufaktur_antenna' => $this->faker->firstName(),
            'tipe_antenna' => $this->faker->name(),
            'sn_antenna' => $this->faker->randomNumber(6),
            'tglinstall_antenna' => $this->faker->date('d-M-Y'),
            'manufaktur_modem_vsat' => $this->faker->firstName(),
            'tipe_modem_vsat' => $this->faker->name(),
            'sn_modem_vsat' => $this->faker->randomNumber(6),
            'tglinstall_modem_vsat' => $this->faker->date('d-M-Y'),
            'manufaktur_modem_gsm' => $this->faker->firstName(),
            'tipe_modem_gsm' => $this->faker->name(),
            'sn_modem_gsm' => $this->faker->randomNumber(6),
            'tglinstall_modem_gsm' => $this->faker->date('d-M-Y'),
            'manufaktur_gps' => $this->faker->firstName(),
            'tipe_gps' => $this->faker->name(),
            'sn_gps' => $this->faker->randomNumber(6),
            'tglinstall_gps' => $this->faker->date('d-M-Y'),
            'manufaktur_solar' => $this->faker->firstName(),
            'tipe_solar' => $this->faker->name(),
            'sn_solar' => $this->faker->randomNumber(6),
            'tglinstall_solar' => $this->faker->date('d-M-Y'),
            'manufaktur_charge' => $this->faker->firstName(),
            'tipe_charge' => $this->faker->name(),
            'sn_charge' => $this->faker->randomNumber(6),
            'tglinstall_charge' => $this->faker->date('d-M-Y'),
            'manufaktur_battery' => $this->faker->firstName(),
            'tipe_battery' => $this->faker->name(),
            'sn_battery' => $this->faker->randomNumber(6),
            'tglinstall_battery' => $this->faker->date('d-M-Y'),
            'ip_digitizer' => $this->faker->randomNumber(6),
            'ip_modem_vsat' => $this->faker->randomNumber(6),
            'ip_modem_gsm' => $this->faker->randomNumber(6),

        ];
    }
}
