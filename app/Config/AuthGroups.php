<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'editor';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => 'Akses penuh ke seluruh sistem, termasuk user & permission management.',
        ],
        'admin' => [
            'title'       => 'Admin',
            'description' => 'Akses operasional harian: kelola produk, konten, pesan, dan pengaturan.',
        ],
        'editor' => [
            'title'       => 'Editor',
            'description' => 'Kelola konten (produk, insight, recipe, article, activity) tanpa akses user & setting.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'admin.access'      => 'Dapat mengakses area admin/dashboard',
        'products.manage'   => 'Kelola produk & kategori produk',
        'insights.manage'   => 'Kelola Baking Insight',
        'recipes.manage'    => 'Kelola Recipe',
        'articles.manage'   => 'Kelola Article',
        'activities.manage' => 'Kelola Activity (Event/CSR/Seminar/Workshop/Pameran)',
        'messages.manage'   => 'Kelola Kontak',
        'partners.manage'   => 'Kelola Partner',
        'testimonials.manage' => 'Kelola Testimonial',
        'faqs.manage'       => 'Kelola FAQ',
        'banners.manage'    => 'Kelola Banner',
        'seo.manage'        => 'Kelola SEO global',
        'settings.manage'   => 'Kelola Setting perusahaan',
        'users.manage'      => 'Kelola User Management',
        'permissions.manage'=> 'Kelola Permission Management',
        'backups.manage'    => 'Kelola Backup Management',
        'analytics.view'    => 'Lihat Visitor Analytics',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => [
            'admin.*',
            'products.*',
            'insights.*',
            'recipes.*',
            'articles.*',
            'activities.*',
            'messages.*',
            'partners.*',
            'testimonials.*',
            'faqs.*',
            'banners.*',
            'seo.*',
            'settings.*',
            'users.*',
            'permissions.*',
            'backups.*',
            'analytics.*',
        ],
        'admin' => [
            'admin.access',
            'products.manage',
            'insights.manage',
            'recipes.manage',
            'articles.manage',
            'activities.manage',
            'messages.manage',
            'partners.manage',
            'testimonials.manage',
            'faqs.manage',
            'banners.manage',
            'seo.manage',
            'settings.manage',
            'analytics.view',
        ],
        'editor' => [
            'admin.access',
            'products.manage',
            'insights.manage',
            'recipes.manage',
            'articles.manage',
            'activities.manage',
        ],
    ];
}
