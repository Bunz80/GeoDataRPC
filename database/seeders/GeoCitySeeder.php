<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use Illuminate\Support\Facades\File;

class GeoCitySeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('dump/gi_comuni.json');

        if (!File::exists($filePath)) {
            echo "⚠️  File gi_comuni.json non trovato in /database/dump/\n";
            return;
        }

        $cities = json_decode(File::get($filePath), true);

        foreach ($cities as $city) {
            $province = GeoProvince::where('abbreviation', $city['sigla_provincia'])->first();

            if ($province) {
                GeoCity::updateOrCreate([
                    'istat_code' => $city['codice_istat'],
                ], [
                    'name' => $city['denominazione_ita'],
                    'belfiore_code' => $city['codice_belfiore'],
                    'latitude' => $city['lat'],
                    'longitude' => $city['lon'],
                    'surface_kmq' => $city['superficie_kmq'],
                    'is_capital' => $city['flag_capoluogo'] === "SI",
                    'geo_province_id' => $province->id,
                ]);
            }
        }

        echo "✅  Seeder GeoCitySeeder completato con successo!\n";
    }
}
