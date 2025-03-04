<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoPostalCode extends Model
{
    use HasFactory;

    protected $fillable = ['postal_code', 'geo_city_id'];

    public function city()
    {
        return $this->belongsTo(GeoCity::class, 'geo_city_id');
    }
}
