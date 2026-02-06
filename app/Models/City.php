<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'property_count',
        'link',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'property_count' => 'integer',
    ];

    /**
     * Scope to get only active cities
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope to order by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('main/images/city/delhi.jpg'); // Default image
        }

        // If it's already a full path, return as is
        if (Str::startsWith($this->image, ['http://', 'https://', '/'])) {
            return $this->image;
        }

        // If it contains 'main/images/', return with asset()
        if (Str::contains($this->image, 'main/images/')) {
            return asset($this->image);
        }

        // If it's uploaded file, return from storage
        if (Str::startsWith($this->image, 'cities/')) {
            return asset('storage/' . $this->image);
        }

        // Otherwise, assume it's just a filename and prepend the path
        return asset('main/images/city/' . $this->image);
    }

    /**
     * Get formatted property count
     */
    public function getFormattedPropertyCountAttribute()
    {
        if ($this->property_count >= 1000) {
            return number_format($this->property_count / 1000, 1) . 'K+ Properties';
        }
        return $this->property_count . '+ Properties';
    }

    /**
     * Automatically generate slug when creating/updating
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($city) {
            if (empty($city->slug)) {
                $city->slug = Str::slug($city->name);
            }
        });

        static::updating(function ($city) {
            if ($city->isDirty('name') && empty($city->slug)) {
                $city->slug = Str::slug($city->name);
            }
        });
    }
}