<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeoPostalCode;
use App\Models\GeoCity;
use Illuminate\Support\Facades\File;

class GeoPostalCodeSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('dump/gi_cap.json');

        if (!File::exists($filePath)) {
            echo "⚠️  File gi_cap.json non trovato in /database/dump/\n";
            return;
        }

        $caps = json_decode(File::get($filePath), true);

        foreach ($caps as $cap) {
            $city = GeoCity::where('istat_code', $cap['codice_istat'])->first();

            if ($city) {
                GeoPostalCode::updateOrCreate([
                    'postal_code' => $cap['cap'],
                    'geo_city_id' => $city->id,
                ]);
            }
        }

        echo "✅  Seeder GeoPostalCodeSeeder completato con successo!\n";
    }
}
