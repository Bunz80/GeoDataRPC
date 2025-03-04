<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'istat_code', 'name', 'belfiore_code', 'latitude', 'longitude', 'surface_kmq', 'is_capital', 'geo_province_id'
    ];

    public function province()
    {
        return $this->belongsTo(GeoProvince::class, 'geo_province_id');
    }

    public function postalCodes()
    {
        return $this->hasMany(GeoPostalCode::class, 'geo_city_id');
    }
}
