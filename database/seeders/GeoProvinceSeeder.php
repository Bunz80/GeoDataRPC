<?php

namespace Database\Seeders;

use App\Models\GeoProvince;
use App\Models\GeoRegion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GeoProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('dump/gi_province.json');

        if (! File::exists($filePath)) {
            echo "⚠️  File provinces.json non trovato in /database/dump/\n";

            return;
        }

        $provinces = json_decode(File::get($filePath), true);

        foreach ($provinces as $province) {
            $region = GeoRegion::where('istat_code', $province['codice_regione'])->first();

            if ($region) {
                GeoProvince::updateOrCreate([
                    'istat_code' => $province['codice_sovracomunale'],
                ], [
                    'name' => $province['denominazione_provincia'],
                    'abbreviation' => $province['sigla_provincia'],
                    'type' => $province['tipologia_provincia'],
                    'num_municipalities' => $province['numero_comuni'],
                    'surface_kmq' => $province['superficie_kmq'],
                    'geo_region_id' => $region->id,
                ]);
            }
        }

        echo "✅  Seeder GeoProvinceSeeder completato con successo!\n";
    }
}
