<?php

namespace Database\Seeders;

use App\Models\GeoZone;
use Illuminate\Database\Seeder;

class GeoZoneSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            ['id' => 1, 'name' => 'Nord-ovest'],
            ['id' => 2, 'name' => 'Nord-est'],
            ['id' => 3, 'name' => 'Centro'],
            ['id' => 4, 'name' => 'Sud'],
            ['id' => 5, 'name' => 'Isole'],
        ];

        foreach ($zones as $zone) {
            GeoZone::updateOrCreate(['id' => $zone['id']], $zone);
        }
    }
}
