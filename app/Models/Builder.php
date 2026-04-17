<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Builder extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'video_path',
        'youtube_url',
        'description',
        'website',
        'email',
        'phone',
        'address',
        'established_year',
        'is_verified',
        'status',
        'display_order',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'status' => 'boolean',
        'established_year' => 'integer',
    ];

    // Relationships
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'builder_amenity');
    }

    public function projectStatuses(): BelongsToMany
    {
        return $this->belongsToMany(ProjectStatus::class, 'builder_project_status');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('name');
    }

    // Accessors
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->name, 0, 2));
    }
}
