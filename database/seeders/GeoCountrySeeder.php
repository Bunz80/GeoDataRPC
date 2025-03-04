<?php

namespace Database\Seeders;

use App\Models\GeoCountry;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class GeoCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Percorso del file CSV
        $filePath = database_path('dump/GeoCountry.csv');

        // Legge il file CSV
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // Imposta la prima riga come intestazione

        // Itera su ogni riga del CSV
        foreach ($csv as $record) {
            GeoCountry::create([
                'id' => $record['id'],
                'name' => $record['name'],
                'code' => $record['codice'],
            ]);
        }
    }
}
