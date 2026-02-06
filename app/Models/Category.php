<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'icon_upload',
        'link',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Scope to get only active categories
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
     * Get the icon URL
     */
    public function getIconUrlAttribute()
    {
        // Priority 1: Use uploaded icon if available
        if ($this->icon_upload) {
            return asset('storage/' . $this->icon_upload);
        }
        
        // Priority 2: Use manual icon path
        if ($this->icon) {
            // If it's already a full path, return as is
            if (Str::startsWith($this->icon, ['http://', 'https://', '/'])) {
                return $this->icon;
            }

            // If it contains 'main/icons/', return with asset()
            if (Str::contains($this->icon, 'main/icons/')) {
                return asset($this->icon);
            }

            // Otherwise, assume it's just a filename and prepend the path
            return asset('main/icons/' . $this->icon);
        }
        
        // Default icon
        return asset('main/icons/living-house.svg');
    }

    /**
     * Automatically generate slug when creating/updating
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
