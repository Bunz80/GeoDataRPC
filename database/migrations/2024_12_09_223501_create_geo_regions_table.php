<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('geo_regions', function (Blueprint $table) {
            $table->id();
            $table->string('istat_code')->unique();
            $table->string('name')->unique();
            $table->string('type'); // Statuto ordinario/speciale
            $table->integer('num_provinces');
            $table->integer('num_municipalities');
            $table->decimal('surface_kmq', 10, 4);
            $table->foreignId('geo_zone_id')->constrained('geo_zones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geo_regions');
    }
};
