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
        Schema::create('geo_cities', function (Blueprint $table) {
            $table->id();
            $table->string('istat_code')->unique();
            $table->string('name');
            $table->string('belfiore_code')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('surface_kmq', 10, 4);
            $table->boolean('is_capital')->default(false);
            $table->foreignId('geo_province_id')->constrained('geo_provinces')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geo_cities');
    }
};
