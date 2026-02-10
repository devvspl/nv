<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
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
     * Get the service types associated with this property type.
     */
    public function serviceTypes()
    {
        return $this->belongsToMany(ServiceType::class, 'property_type_service_type')
                    ->withTimestamps();
    }

    /**
     * Scope a query to only include active property types.
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
