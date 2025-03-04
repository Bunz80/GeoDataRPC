<?php

namespace Database\Seeders;

use App\Models\GeoRegion;
use App\Models\GeoZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GeoRegionSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('dump/gi_regioni.json');

        if (! File::exists($filePath)) {
            echo "⚠️  File regions.json non trovato in /database/dump/\n";

            return;
        }

        $regions = json_decode(File::get($filePath), true);

        foreach ($regions as $region) {
            $zone = GeoZone::where('name', $region['ripartizione_geografica'])->first();

            if ($zone) {
                GeoRegion::updateOrCreate([
                    'istat_code' => $region['codice_regione'],
                ], [
                    'name' => $region['denominazione_regione'],
                    'type' => $region['tipologia_regione'],
                    'num_provinces' => $region['numero_province'],
                    'num_municipalities' => $region['numero_comuni'],
                    'surface_kmq' => $region['superficie_kmq'],
                    'geo_zone_id' => $zone->id,
                ]);
            }
        }

        echo "✅  Seeder GeoRegionSeeder completato con successo!\n";
    }
}
