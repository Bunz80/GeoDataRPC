<?php

namespace GeoDataRPC\Console\Commands;

use Illuminate\Console\Command;

class SeedGeoData extends Command
{
    protected $signature = 'geodata:seed';
    protected $description = 'Popola il database con i dati di regioni, province, comuni e CAP';

    public function handle()
    {
        $this->call('db:seed', ['--class' => 'GeoDataRPC\\Database\\Seeders\\GeoZoneSeeder']);
        $this->call('db:seed', ['--class' => 'GeoDataRPC\\Database\\Seeders\\GeoRegionSeeder']);
        $this->call('db:seed', ['--class' => 'GeoDataRPC\\Database\\Seeders\\GeoProvinceSeeder']);
        $this->call('db:seed', ['--class' => 'GeoDataRPC\\Database\\Seeders\\GeoCitySeeder']);
        $this->call('db:seed', ['--class' => 'GeoDataRPC\\Database\\Seeders\\GeoPostalCodeSeeder']);

        $this->info("✅ Database popolato con successo!");
    }
}