<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ContactInfo extends Model
{
    protected $table = 'contact_info';

    protected $fillable = [
        'section_key',
        'title',
        'content',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getIconUrlAttribute()
    {
        if ($this->icon && Storage::disk('public')->exists($this->icon)) {
            return Storage::url($this->icon);
        }
        return asset('assets/icons/coin.svg'); // Default icon
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
