<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageVisit;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;

class TrackPageVisit
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests for public pages (not admin, api, profile, or assets)
        if ($request->isMethod('get') && 
            !$request->is('admin/*') && 
            !$request->is('api/*') &&
            !$request->is('profile*') &&
            !$request->is('storage/*') &&
            !$request->is('build/*') &&
            !str_contains($request->path(), '.')) {
            
            try {
                $agent = new Agent();
                $agent->setUserAgent($request->userAgent());
                
                // Determine device type
                $deviceType = 'desktop';
                if ($agent->isMobile()) {
                    $deviceType = 'mobile';
                } elseif ($agent->isTablet()) {
                    $deviceType = 'tablet';
                }
                
                // Get page name from route
                $pageName = $this->getPageName($request);
                
                $pageVisit = PageVisit::create([
                    'url' => $request->fullUrl(),
                    'page_name' => $pageName,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'referer' => $request->header('referer'),
                    'device_type' => $deviceType,
                    'browser' => $agent->browser(),
                    'platform' => $agent->platform(),
                    'visited_at' => now(),
                ]);
                
                // Store the page visit ID in session for linking with inquiries
                $request->session()->put('current_page_visit_id', $pageVisit->id);
            } catch (\Exception $e) {
                // Silently fail - don't break the page if tracking fails
                \Log::error('Page visit tracking failed: ' . $e->getMessage());
            }
        }

        return $next($request);
    }

    /**
     * Get a friendly page name from the request
     */
    private function getPageName(Request $request): string
    {
        $routeName = $request->route()?->getName();
        
        // Map route names to friendly page names
        $pageNames = [
            'home' => 'Home',
            'properties.search' => 'Property Search',
            'about' => 'About Us',
            'contact' => 'Contact',
            'services' => 'Services',
            'properties' => 'Properties',
        ];
        
        if ($routeName && isset($pageNames[$routeName])) {
            return $pageNames[$routeName];
        }
        
        // Fallback to path
        $path = trim($request->path(), '/');
        return $path ?: 'Home';
    }
}
