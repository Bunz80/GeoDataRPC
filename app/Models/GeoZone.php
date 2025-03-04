<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoZone extends Model
{
    use HasFactory;

    protected $table = 'geo_zones';

    protected $fillable = ['name'];

    public function regions()
    {
        return $this->hasMany(GeoRegion::class, 'geo_zone_id');
    }
}
