<?php

use App\Services\SettingService;

if (! function_exists('seo_meta')) {
    /**
     * Render <title>, meta description/keywords, canonical, Open Graph & Twitter Card tags.
     * Falls back to global SEO default (Setting > SEO Default) when a field is empty.
     */
    function seo_meta(array $data): string
    {
        $seo = service('settings') ? (new SettingService())->getSeo() : [];

        $title       = $data['title'] ?? $seo['defaultMetaTitle'] ?? 'PGA';
        $description = $data['description'] ?? $seo['defaultMetaDescription'] ?? '';
        $keywords    = $data['keywords'] ?? '';
        $image       = $data['image'] ?? '';
        $url         = $data['url'] ?? current_url();

        $tags = '<title>' . esc($title) . ' &mdash; PT. Pancaran Gemilang Abadi</title>' . "\n";
        $tags .= '<meta name="description" content="' . esc($description) . '">' . "\n";

        if ($keywords) {
            $tags .= '<meta name="keywords" content="' . esc($keywords) . '">' . "\n";
        }

        $tags .= '<link rel="canonical" href="' . esc($url) . '">' . "\n";
        $tags .= '<meta property="og:title" content="' . esc($title) . '">' . "\n";
        $tags .= '<meta property="og:description" content="' . esc($description) . '">' . "\n";
        $tags .= '<meta property="og:type" content="website">' . "\n";
        $tags .= '<meta property="og:url" content="' . esc($url) . '">' . "\n";

        if ($image) {
            $tags .= '<meta property="og:image" content="' . esc(base_url($image)) . '">' . "\n";
        }

        $tags .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
        $tags .= '<meta name="twitter:title" content="' . esc($title) . '">' . "\n";
        $tags .= '<meta name="twitter:description" content="' . esc($description) . '">' . "\n";

        return $tags;
    }
}

if (! function_exists('schema_json')) {
    /**
     * Render a <script type="application/ld+json"> tag for the given schema.org type.
     * Supported $type: Organization, LocalBusiness, Product, Recipe, Article, FAQPage, BreadcrumbList.
     */
    function schema_json(string $type, array $data): string
    {
        $payload = array_merge(['@context' => 'https://schema.org', '@type' => $type], $data);

        return '<script type="application/ld+json">' . json_encode($payload, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }
}
