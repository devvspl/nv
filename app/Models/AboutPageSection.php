<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPageSection extends Model
{
    protected $fillable = [
        'section_title',
        'section_subtitle',
        'who_we_are_title',
        'who_we_are_description',
        'who_we_are_icon',
        'mission_title',
        'mission_description',
        'mission_icon',
        'vision_title',
        'vision_description',
        'vision_icon',
        'values_heading',
        'values_who_we_are',
        'values_mission',
        'values_vision',
        'values_teamwork',
        'team_section_title',
        'team_section_heading',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getActive()
    {
        return self::active()->first();
    }

    public function getWhoWeAreIconUrlAttribute()
    {
        return $this->who_we_are_icon ? asset('storage/' . $this->who_we_are_icon) : null;
    }

    public function getMissionIconUrlAttribute()
    {
        return $this->mission_icon ? asset('storage/' . $this->mission_icon) : null;
    }

    public function getVisionIconUrlAttribute()
    {
        return $this->vision_icon ? asset('storage/' . $this->vision_icon) : null;
    }
}
