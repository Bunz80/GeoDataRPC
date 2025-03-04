<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'contactable_type',
        'contactable_id',
        'collection_name',
        'name',
        'contact',
    ];

    public function contactable()
    {
        return $this->morphTo();
    }
}
