<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PatchViewPermissions extends Command
{
    protected $signature   = 'views:patch-permissions {--dry-run : Show changes without writing}';
    protected $description = 'Wrap action buttons in admin views with @canDo permission checks';

    // folder-name => permission-module
    private const MODULES = [
        'about-page'             => 'about-page',
        'about-us'               => 'about-us',
        'amenities'              => 'amenities',
        'bhks'                   => 'bhks',
        'blogs'                  => 'blogs',
        'builders'               => 'builders',
        'categories'             => 'categories',
        'cities'                 => 'cities',
        'commercial-sections'    => 'commercial-sections',
        'consultations'          => 'consultations',
        'contact-info'           => 'contact-info',
        'contact-page'           => 'contact-page',
        'faqs'                   => 'faqs',
        'features'               => 'features',
        'hero-sections'          => 'hero-sections',
        'inquiries'              => 'inquiries',
        'locations'              => 'locations',
        'our-clients'            => 'our-clients',
        'privacy-policy'         => 'privacy-policy',
        'project-statuses'       => 'project-statuses',
        'properties'             => 'properties',
        'property-inquiries'     => 'property-inquiries',
        'property-page-sections' => 'property-page-sections',
        'property-types'         => 'property-types',
        'service-types'          => 'service-types',
        'team-members'           => 'team-members',
        'terms-and-conditions'   => 'terms-and-conditions',
        'testimonials'           => 'testimonials',
        'users'                  => 'users',
        'work-processes'         => 'work-processes',
    ];

    public function handle(): void
    {
        $dry     = $this->option('dry-run');
        $viewDir = resource_path('views/admin');
        $files   = $this->getBladeFiles($viewDir);
        $patched = 0;

        foreach ($files as $path) {
            $folder = basename(dirname($path));
            if (!isset(self::MODULES[$folder])) {
                continue;
            }

            $mod      = self::MODULES[$folder];
            $viewType = basename($path, '.blade.php'); // index|show|create|edit
            $original = file_get_contents($path);
            $content  = $original;

            // Already fully patched — skip
            if (str_contains($content, "@canDo('{$mod}.create')") &&
                str_contains($content, "@canDo('{$mod}.edit')") &&
                str_contains($content, "@canDo('{$mod}.delete')")) {
                continue;
            }

            $content = $this->wrapCreateButton($content, $mod);
            $content = $this->wrapEditLinks($content, $mod);
            $content = $this->wrapDeleteForms($content, $mod);
            $content = $this->wrapToggleForms($content, $mod);

            if ($content !== $original) {
                if (!$dry) {
                    file_put_contents($path, $content);
                }
                $this->line(($dry ? '[DRY] ' : '') . "Patched: {$path}");
                $patched++;
            }
        }

        $this->info("Done. {$patched} file(s) " . ($dry ? 'would be ' : '') . 'patched.');
    }

    // ── Wrap "Add New" / create links ─────────────────────────────────────────
    private function wrapCreateButton(string $content, string $mod): string
    {
        $route = "admin.{$mod}.create";

        return preg_replace_callback(
            '/(<a\b[^>]*route\(\'' . preg_quote($route, '/') . '\'\)[^>]*>[\s\S]*?<\/a>)/U',
            function ($m) use ($mod) {
                if ($this->alreadyWrapped($m[0], "{$mod}.create")) return $m[0];
                return "@canDo('{$mod}.create')\n{$m[1]}\n@endCanDo";
            },
            $content
        ) ?? $content;
    }

    private function wrapEditLinks(string $content, string $mod): string
    {
        $route = "admin.{$mod}.edit";

        return preg_replace_callback(
            '/(<a\b[^>]*route\(\'' . preg_quote($route, '/') . '\'[^)]*\)[^>]*>[\s\S]*?<\/a>)/U',
            function ($m) use ($mod) {
                if ($this->alreadyWrapped($m[0], "{$mod}.edit")) return $m[0];
                return "@canDo('{$mod}.edit')\n{$m[1]}\n@endCanDo";
            },
            $content
        ) ?? $content;
    }

    // ── Wrap delete forms ──────────────────────────────────────────────────────
    private function wrapDeleteForms(string $content, string $mod): string
    {
        $route = "admin.{$mod}.destroy";

        // Match forms that contain the destroy route — use a simpler non-greedy approach
        return preg_replace_callback(
            '/(<form\b[^>]*>[\s\S]*?' . preg_quote($route, '/') . '[\s\S]*?<\/form>)/U',
            function ($m) use ($mod) {
                if ($this->alreadyWrapped($m[0], "{$mod}.delete")) return $m[0];
                return "@canDo('{$mod}.delete')\n{$m[1]}\n@endCanDo";
            },
            $content
        ) ?? $content;
    }

    // ── Wrap toggle-status / toggle-featured / toggle-verified forms ───────────
    private function wrapToggleForms(string $content, string $mod): string
    {
        return preg_replace_callback(
            '/(<form\b[^>]*>[\s\S]*?admin\.' . preg_quote($mod, '/') . '\.toggle-[a-z-]+[\s\S]*?<\/form>)/U',
            function ($m) use ($mod) {
                if ($this->alreadyWrapped($m[0], "{$mod}.edit")) return $m[0];
                return "@canDo('{$mod}.edit')\n{$m[1]}\n@endCanDo";
            },
            $content
        ) ?? $content;
    }

    private function alreadyWrapped(string $snippet, string $perm): bool
    {
        // Check if the 200 chars before this snippet in the full file contain @canDo
        return str_contains($snippet, "@canDo('{$perm}')");
    }

    private function getBladeFiles(string $dir): array
    {
        $files = [];
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir)) as $file) {
            if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
                $files[] = $file->getPathname();
            }
        }
        return $files;
    }
}
