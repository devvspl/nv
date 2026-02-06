<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'mission_text',
        'checklist_items',
        'stats',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'checklist_items' => 'array',
        'stats' => 'array',
        'status' => 'boolean',
    ];

    /**
     * Scope to get only active about us entries
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
     * Get the first active about us entry
     */
    public static function getActive()
    {
        return self::active()->ordered()->first();
    }
}