<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoRegion extends Model
{
    protected $table = 'geo_regions';

    protected $fillable = [
        'istat_code', 'name', 'type', 'num_provinces', 'num_municipalities', 'surface_kmq', 'geo_zone_id',
    ];

    public function zone()
    {
        return $this->belongsTo(GeoZone::class, 'geo_zone_id');
    }

    public function provinces()
    {
        return $this->hasMany(GeoProvince::class, 'geo_region_id');
    }
}
