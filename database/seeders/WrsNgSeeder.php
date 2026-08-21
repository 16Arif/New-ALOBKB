<?php

namespace Database\Seeders;

use App\Models\WrsNg;
use Illuminate\Database\Seeder;

class WrsNgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialData = [
            [
                'nama_site' => 'WRS-BKB01 - BPBD Balikpapan',
                'lokasi' => 'Pusdalops BPBD Kota Balikpapan, Jl. Ruhui Rahayu',
                'latitude' => '-1.252400',
                'longitude' => '116.861200',
            ],
            [
                'nama_site' => 'WRS-BKB02 - Basarnas Kaltim',
                'lokasi' => 'Kantor Pencarian & Pertolongan (Basarnas) Balikpapan',
                'latitude' => '-1.261800',
                'longitude' => '116.891500',
            ],
            [
                'nama_site' => 'WRS-SMD01 - BPBD Prov Kaltim',
                'lokasi' => 'Pusdalops BPBD Provinsi Kalimantan Timur, Jl. MT Haryono Samarinda',
                'latitude' => '-0.485200',
                'longitude' => '117.158300',
            ],
            [
                'nama_site' => 'WRS-BRU01 - BPBD Berau',
                'lokasi' => 'Kantor BPBD Kabupaten Berau, Jl. Pemuda Tanjung Redeb',
                'latitude' => '2.148500',
                'longitude' => '117.498200',
            ],
            [
                'nama_site' => 'WRS-TRK01 - BPBD Tarakan',
                'lokasi' => 'Pusdalops BPBD Kota Tarakan, Kalimantan Utara',
                'latitude' => '3.315000',
                'longitude' => '117.585000',
            ],
        ];

        foreach ($initialData as $data) {
            WrsNg::firstOrCreate(
                ['nama_site' => $data['nama_site']],
                $data
            );
        }

        // Generate additional dummy data via Factory
        WrsNg::factory()->count(10)->create();
    }
}
