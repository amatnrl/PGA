<?php

if (! function_exists('vite_assets')) {
    /**
     * Inject Vite asset tags for the given entry (e.g. 'site-css', 'site-js').
     * In development, points to the Vite dev server for HMR.
     * In production, reads public/build/manifest.json for the hashed file paths.
     */
    function vite_assets(array $entries): string
    {
        $isDev = ENVIRONMENT === 'development' && is_vite_dev_server_running();

        if ($isDev) {
            $tags = '<script type="module" src="http://localhost:5173/build/@vite/client"></script>' . "\n";
            foreach ($entries as $entry) {
                $path = vite_entry_source_path($entry);
                $tags .= '<script type="module" src="http://localhost:5173/build/' . $path . '"></script>' . "\n";
            }

            return $tags;
        }

        $manifestPath = FCPATH . 'build/.vite/manifest.json';

        if (! is_file($manifestPath)) {
            return '';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true) ?? [];
        $tags     = '';

        foreach ($entries as $entry) {
            $source = vite_entry_source_path($entry);

            if (! isset($manifest[$source])) {
                continue;
            }

            $item = $manifest[$source];

            if (str_ends_with($item['file'], '.css')) {
                $tags .= '<link rel="stylesheet" href="' . base_url('build/' . $item['file']) . '">' . "\n";
            } else {
                $tags .= '<script type="module" src="' . base_url('build/' . $item['file']) . '"></script>' . "\n";
            }

            foreach ($item['css'] ?? [] as $css) {
                $tags .= '<link rel="stylesheet" href="' . base_url('build/' . $css) . '">' . "\n";
            }
        }

        return $tags;
    }
}

if (! function_exists('vite_entry_source_path')) {
    function vite_entry_source_path(string $entry): string
    {
        $map = [
            'admin-css' => 'resources/css/admin.css',
            'admin-js'  => 'resources/js/admin.js',
            'site-css'  => 'resources/css/site.css',
            'site-js'   => 'resources/js/site.js',
        ];

        return $map[$entry] ?? $entry;
    }
}

if (! function_exists('is_vite_dev_server_running')) {
    function is_vite_dev_server_running(): bool
    {
        static $running = null;

        if ($running === null) {
            $connection = @fsockopen('localhost', 5173, $errno, $errstr, 0.2);
            $running    = is_resource($connection);

            if ($running) {
                fclose($connection);
            }
        }

        return $running;
    }
}
