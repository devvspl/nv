<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertySpecification extends Model
{
    protected $fillable = [
        'property_id',
        'total_floors',
        'floor_number',
        'bedrooms',
        'bathrooms',
        'balconies',
        'parking_spaces',
        'furnishing_status',
        'facing',
        'age_of_property',
        'possession_date',
        'rera_id',
    ];

    protected $casts = [
        'possession_date' => 'date',
    ];

    // Relationships
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    // Accessors
    public function getFormattedFurnishingStatusAttribute(): string
    {
        return match($this->furnishing_status) {
            'unfurnished' => 'Unfurnished',
            'semi_furnished' => 'Semi Furnished',
            'fully_furnished' => 'Fully Furnished',
            default => 'N/A',
        };
    }

    public function getFormattedFacingAttribute(): string
    {
        return match($this->facing) {
            'north' => 'North',
            'south' => 'South',
            'east' => 'East',
            'west' => 'West',
            'north_east' => 'North East',
            'north_west' => 'North West',
            'south_east' => 'South East',
            'south_west' => 'South West',
            default => 'N/A',
        };
    }
}
