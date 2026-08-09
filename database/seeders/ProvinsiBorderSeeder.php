<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProvinsiBorderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate table first to prevent duplicates
        DB::table('provinsi_borders')->truncate();

        $path = public_path('border/kalimantan_provinces_simplified.geojson');
        if (!File::exists($path)) {
            $this->command->error("GeoJSON file not found at: {$path}");
            return;
        }

        $geojson = json_decode(File::get($path), true);
        if (!$geojson || !isset($geojson['features'])) {
            $this->command->error("Invalid GeoJSON format.");
            return;
        }

        $inserted = 0;

        foreach ($geojson['features'] as $feature) {
            $properties = $feature['properties'] ?? [];
            $geometry = $feature['geometry'] ?? [];

            $kodeProv = $properties['KODE_PROV'] ?? null;
            $namaProvinsi = $properties['PROVINSI'] ?? null;
            
            if (!$kodeProv || !$namaProvinsi || empty($geometry)) {
                continue;
            }

            try {
                $wkt = $this->geometryToWkt($geometry);
                
                DB::table('provinsi_borders')->insert([
                    'kode_prov' => $kodeProv,
                    'nama_provinsi' => $namaProvinsi,
                    'geom' => DB::raw("ST_GeomFromText('{$wkt}')"),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $inserted++;
            } catch (\Exception $e) {
                $this->command->error("Failed to insert province {$namaProvinsi}: " . $e->getMessage());
            }
        }

        $this->command->info("Successfully seeded {$inserted} provinces into provinsi_borders table.");
    }

    /**
     * Convert GeoJSON geometry to WKT MultiPolygon.
     */
    private function geometryToWkt(array $geometry): string
    {
        $type = strtoupper($geometry['type'] ?? '');
        $coords = $geometry['coordinates'] ?? [];

        if ($type === 'POLYGON') {
            $coords = [$coords];
        } elseif ($type !== 'MULTIPOLYGON') {
            throw new \InvalidArgumentException("Unsupported geometry type: {$type}");
        }

        $polygonsWkt = [];
        foreach ($coords as $polygon) {
            $ringsWkt = [];
            foreach ($polygon as $ring) {
                $pointsWkt = [];
                foreach ($ring as $coord) {
                    // Coordinate format: [longitude, latitude]
                    $pointsWkt[] = $coord[0] . ' ' . $coord[1];
                }
                // Ensure WKT polygon rings close properly (first and last coordinate match)
                if (count($ring) > 0 && ($ring[0][0] !== end($ring)[0] || $ring[0][1] !== end($ring)[1])) {
                    $pointsWkt[] = $ring[0][0] . ' ' . $ring[0][1];
                }
                $ringsWkt[] = '(' . implode(', ', $pointsWkt) . ')';
            }
            $polygonsWkt[] = '(' . implode(', ', $ringsWkt) . ')';
        }

        return 'MULTIPOLYGON(' . implode(', ', $polygonsWkt) . ')';
    }
}
