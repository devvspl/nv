<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Get the property types associated with this service type.
     */
    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class, 'property_type_service_type')
                    ->withTimestamps();
    }

    /**
     * Scope a query to only include active service types.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to order by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
