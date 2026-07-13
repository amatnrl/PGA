<?php

namespace App\Libraries;

/**
 * Single source of truth for the admin sidebar navigation, also reused
 * by the topbar search box so both stay in sync automatically.
 */
class AdminMenu
{
    public static function groups(): array
    {
        return [
            [
                'label' => 'Overview',
                'items' => [
                    ['label' => 'Dashboard', 'url' => 'admin', 'icon' => 'dashboard'],
                    ['label' => 'Visitor Analytics', 'url' => 'admin/analytics', 'icon' => 'chart'],
                ],
            ],
            [
                'label' => 'Content',
                'items' => [
                    ['label' => 'Product', 'url' => 'admin/products', 'icon' => 'box'],
                    ['label' => 'Jalur Distribusi', 'url' => 'admin/branches', 'icon' => 'branch'],
                    ['label' => 'Baking Insight', 'url' => 'admin/insights', 'icon' => 'insight'],
                    ['label' => 'Recipe', 'url' => 'admin/recipes', 'icon' => 'recipe'],
                    ['label' => 'Article', 'url' => 'admin/articles', 'icon' => 'article'],
                    ['label' => 'Activity', 'url' => 'admin/activities', 'icon' => 'activity'],
                    ['label' => 'Banner', 'url' => 'admin/banners', 'icon' => 'banner'],
                    ['label' => 'FAQ', 'url' => 'admin/faqs', 'icon' => 'faq'],
                    ['label' => 'Partner', 'url' => 'admin/partners', 'icon' => 'partner'],
                    ['label' => 'Testimonial', 'url' => 'admin/testimonials', 'icon' => 'star'],
                    ['label' => 'Kontak', 'url' => 'admin/messages', 'icon' => 'mail'],
                ],
            ],
            [
                'label' => 'System',
                'items' => [
                    ['label' => 'User Management', 'url' => 'admin/users', 'icon' => 'user'],
                    ['label' => 'Backup Management', 'url' => 'admin/backups', 'icon' => 'database'],
                    ['label' => 'Setting', 'url' => 'admin/settings', 'icon' => 'settings'],
                    ['label' => 'Panduan Penggunaan', 'url' => 'admin/guide', 'icon' => 'guide'],
                ],
            ],
        ];
    }

    /** Flat list of [label, url] for the topbar quick-search. */
    public static function flat(): array
    {
        $flat = [];

        foreach (self::groups() as $group) {
            foreach ($group['items'] as $item) {
                $flat[] = ['label' => $item['label'], 'url' => $item['url']];
            }
        }

        return $flat;
    }
}
