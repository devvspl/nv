<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageVisit extends Model
{
    protected $fillable = [
        'url',
        'page_name',
        'ip_address',
        'user_agent',
        'referer',
        'device_type',
        'browser',
        'platform',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Get total visits count
     */
    public static function getTotalVisits()
    {
        return self::count();
    }

    /**
     * Get today's visits count
     */
    public static function getTodayVisits()
    {
        return self::whereDate('visited_at', today())->count();
    }

    /**
     * Get this week's visits count
     */
    public static function getWeekVisits()
    {
        return self::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
    }

    /**
     * Get this month's visits count
     */
    public static function getMonthVisits()
    {
        return self::whereMonth('visited_at', now()->month)
                   ->whereYear('visited_at', now()->year)
                   ->count();
    }

    /**
     * Get unique visitors count
     */
    public static function getUniqueVisitors($period = 'all')
    {
        $query = self::select('ip_address')->distinct();
        
        switch ($period) {
            case 'today':
                $query->whereDate('visited_at', today());
                break;
            case 'week':
                $query->whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('visited_at', now()->month)
                      ->whereYear('visited_at', now()->year);
                break;
        }
        
        return $query->count();
    }

    /**
     * Get most visited pages
     */
    public static function getMostVisitedPages($limit = 10)
    {
        return self::select('page_name', DB::raw('COUNT(*) as visits'))
                   ->whereNotNull('page_name')
                   ->groupBy('page_name')
                   ->orderByDesc('visits')
                   ->limit($limit)
                   ->get();
    }

    /**
     * Get visits by device type
     */
    public static function getVisitsByDevice()
    {
        return self::select('device_type', DB::raw('COUNT(*) as count'))
                   ->whereNotNull('device_type')
                   ->groupBy('device_type')
                   ->get();
    }

    /**
     * Get visits by browser
     */
    public static function getVisitsByBrowser($limit = 5)
    {
        return self::select('browser', DB::raw('COUNT(*) as count'))
                   ->whereNotNull('browser')
                   ->groupBy('browser')
                   ->orderByDesc('count')
                   ->limit($limit)
                   ->get();
    }

    /**
     * Get daily visits for the last N days
     */
    public static function getDailyVisits($days = 7)
    {
        return self::select(
                        DB::raw('DATE(visited_at) as date'),
                        DB::raw('COUNT(*) as visits')
                    )
                    ->where('visited_at', '>=', now()->subDays($days))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
    }

    /**
     * Get recent visits
     */
    public static function getRecentVisits($limit = 10)
    {
        return self::orderByDesc('visited_at')->limit($limit)->get();
    }
}
