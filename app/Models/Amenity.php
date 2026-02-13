<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Amenity extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'category',
        'status',
        'display_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Relationships
    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'property_amenities')
                    ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('name');
    }
}
