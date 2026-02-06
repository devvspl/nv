<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tag',
        'icon',
        'icon_upload',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active features
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Scope to filter by tag
     */
    public function scopeByTag($query, $tag)
    {
        return $query->where('tag', $tag);
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
            if (str_starts_with($this->icon, 'main/icons/')) {
                return asset($this->icon);
            }
            return asset('main/icons/' . $this->icon);
        }
        
        return null;
    }
}
