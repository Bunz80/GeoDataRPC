<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_name',
        'name',
        'icon',
        'color',
        'order',
        'parent_id',
        'is_default',
        'is_activated',
    ];

    public static function getCategoryName($id)
    {
        $categoria = self::find($id);

        return $categoria ? $categoria->name : 'N/A';

        return $categoria->name;
    }

    protected static function booted()
    {
        static::saved(function ($category) {
            $category->afterSave();
        });
    }

    protected function afterSave()
    {
        // Imposta is_activated a true
        $this->is_activated = true;
        $this->saveQuietly();

        // Trova tutti gli altri record con lo stesso collection_name
        Category::where('collection_name', $this->collection_name)
            ->where('id', '!=', $this->id)
            ->update(['is_default' => false]);
    }

    /**
     * Get the parent category
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
