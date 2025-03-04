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
        Schema::create('geo_provinces', function (Blueprint $table) {
            $table->id();
            $table->string('istat_code')->unique();
            $table->string('name');
            $table->string('abbreviation', 10);
            $table->string('type'); // Provincia, Città Metropolitana, Libero Consorzio
            $table->integer('num_municipalities');
            $table->decimal('surface_kmq', 10, 4);
            $table->foreignId('geo_region_id')->constrained('geo_regions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geo_provinces');
    }
};
