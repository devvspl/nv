<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ContactPageSection extends Model
{
    protected $fillable = [
        'section_key',
        'heading',
        'subheading',
        'description',
        'banner_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getBannerImageUrlAttribute()
    {
        if ($this->banner_image && Storage::disk('public')->exists($this->banner_image)) {
            return Storage::url($this->banner_image);
        }
        return 'https://zendoindia.com/new-home/zendo/assets/images/bg/cta-bg.jpg'; // Default banner
    }

    public static function getByKey($key)
    {
        return self::where('section_key', $key)->where('is_active', true)->first();
    }
}
