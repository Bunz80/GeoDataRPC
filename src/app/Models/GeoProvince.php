<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoProvince extends Model
{
    protected $table = 'geo_provinces';

    protected $fillable = [
        'istat_code',
        'name',
        'abbreviation',
        'type',
        'num_municipalities',
        'surface_kmq',
        'geo_region_id',
    ];

    public function region()
    {
        return $this->belongsTo(GeoRegion::class, 'geo_region_id');
    }
}
