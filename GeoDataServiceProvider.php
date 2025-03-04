<?php

namespace GeoDataRPC;

use Illuminate\Support\ServiceProvider;

class GeoDataServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Carica le migrazioni
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        // Pubblica i file JSON per il seeding
        $this->publishes([
            __DIR__ . '/Database/dump/' => database_path('dump/'),
        ], 'geodata-rpc');

        // Comandi post-installazione
        if ($this->app->runningInConsole()) {
            $this->commands([
                \GeoDataRPC\Console\Commands\SeedGeoData::class,
            ]);
        }
    }

    public function register()
    {
        //
    }
}