<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsAndCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'effective_date',
        'last_updated'
    ];

    protected $casts = [
        'effective_date' => 'date',
        'last_updated' => 'date'
    ];

    /**
     * Get the active terms record (first row)
     */
    public static function getActive()
    {
        return self::first();
    }
}
