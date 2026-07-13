<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

service('auth')->routes($routes, ['except' => ['register']]);

// Public site routes
$routes->get('sitemap.xml', 'SitemapController::index', ['namespace' => 'App\Controllers\Site']);

$routes->group('', ['namespace' => 'App\Controllers\Site'], function (RouteCollection $routes) {
    $routes->get('/', 'Home::index');
    $routes->get('about', 'About::index');

    $routes->get('product', 'ProductController::index');
    $routes->get('product/(:segment)', 'ProductController::show/$1');

    $routes->get('explore', 'Explore::index');
    $routes->get('explore/insight', 'Explore::insights');
    $routes->get('explore/insight/(:segment)', 'Explore::insight/$1');
    $routes->get('explore/recipe', 'Explore::recipes');
    $routes->get('explore/recipe/(:segment)', 'Explore::recipe/$1');
    $routes->get('explore/article', 'Explore::articles');
    $routes->get('explore/article/(:segment)', 'Explore::article/$1');
    $routes->get('explore/activity', 'Explore::activities');
    $routes->get('explore/activity/(:segment)', 'Explore::activity/$1');

    $routes->get('contact', 'Contact::index');
});

// Admin (CMS) routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'session'], function (RouteCollection $routes) {
    $routes->get('/', 'Dashboard::index');

    // Product
    $routes->group('products', ['filter' => 'permission:products.manage'], function (RouteCollection $routes) {
        $routes->get('/', 'ProductController::index');
        $routes->get('create', 'ProductController::create');
        $routes->post('/', 'ProductController::store');
        $routes->get('(:num)/edit', 'ProductController::edit/$1');
        $routes->post('(:num)', 'ProductController::update/$1');
        $routes->post('(:num)/delete', 'ProductController::delete/$1');
        $routes->post('(:num)/toggle-featured', 'ProductController::toggleFeatured/$1');
        $routes->post('(:num)/images/(:num)/delete', 'ProductController::deleteImage/$1/$2');
    });

    // Banner / Partner / Testimonial / FAQ / Product Highlight (SimpleCrudController pattern)
    foreach (
        [
            'banners'      => ['controller' => 'BannerController', 'permission' => 'banners.manage'],
            'partners'     => ['controller' => 'PartnerController', 'permission' => 'partners.manage'],
            'testimonials' => ['controller' => 'TestimonialController', 'permission' => 'testimonials.manage'],
            'faqs'         => ['controller' => 'FaqController', 'permission' => 'faqs.manage'],
        ] as $prefix => $cfg
    ) {
        $routes->group($prefix, ['filter' => 'permission:' . $cfg['permission']], function (RouteCollection $routes) use ($cfg) {
            $controller = $cfg['controller'];
            $routes->get('/', $controller . '::index');
            $routes->get('create', $controller . '::create');
            $routes->post('/', $controller . '::store');
            $routes->get('(:num)/edit', $controller . '::edit/$1');
            $routes->post('(:num)', $controller . '::update/$1');
            $routes->post('(:num)/delete', $controller . '::delete/$1');
            $routes->post('(:num)/toggle-status', $controller . '::toggleStatus/$1');
        });
    }

    // Insight / Recipe / Article / Activity (shared ContentCrudController pattern)
    foreach (
        [
            'insights'   => ['controller' => 'InsightController', 'permission' => 'insights.manage'],
            'articles'   => ['controller' => 'ArticleController', 'permission' => 'articles.manage'],
            'recipes'    => ['controller' => 'RecipeController', 'permission' => 'recipes.manage'],
            'activities' => ['controller' => 'ActivityController', 'permission' => 'activities.manage'],
        ] as $prefix => $cfg
    ) {
        $routes->group($prefix, ['filter' => 'permission:' . $cfg['permission']], function (RouteCollection $routes) use ($cfg) {
            $controller = $cfg['controller'];
            $routes->get('/', $controller . '::index');
            $routes->get('create', $controller . '::create');
            $routes->post('/', $controller . '::store');
            $routes->get('(:num)/edit', $controller . '::edit/$1');
            $routes->post('(:num)', $controller . '::update/$1');
            $routes->post('(:num)/delete', $controller . '::delete/$1');
        });
    }

    // Branches
    $routes->group('branches', ['filter' => 'permission:settings.manage'], function (RouteCollection $routes) {
        $routes->get('/', 'BranchController::index');
        $routes->get('create', 'BranchController::create');
        $routes->post('/', 'BranchController::store');
        $routes->get('(:num)/edit', 'BranchController::edit/$1');
        $routes->post('(:num)', 'BranchController::update/$1');
        $routes->post('(:num)/delete', 'BranchController::delete/$1');
    });

    // Kontak (WhatsApp / Email / Alamat)
    $routes->group('messages', ['filter' => 'permission:messages.manage'], function (RouteCollection $routes) {
        $routes->get('/', 'ContactMessageController::index');
        $routes->post('/', 'ContactMessageController::update');
    });

    // Visitor Analytics (read-only)
    $routes->group('analytics', ['filter' => 'permission:analytics.view'], function (RouteCollection $routes) {
        $routes->get('/', 'VisitorAnalyticsController::index');
    });

    // Setting (+ About Content sub-modules: core values, team, certifications, milestones, gallery)
    $routes->group('settings', ['filter' => 'permission:settings.manage'], function (RouteCollection $routes) {
        $routes->get('/', 'SettingController::index');
        $routes->post('/', 'SettingController::update');
    });

    foreach (
        [
            'core-values'   => 'CoreValueController',
            'team-members'  => 'TeamMemberController',
            'certifications' => 'CertificationController',
            'milestones'    => 'MilestoneController',
            'galleries'     => 'GalleryController',
        ] as $prefix => $controller
    ) {
        $routes->group($prefix, ['filter' => 'permission:settings.manage'], function (RouteCollection $routes) use ($controller) {
            $routes->get('/', $controller . '::index');
            $routes->get('create', $controller . '::create');
            $routes->post('/', $controller . '::store');
            $routes->get('(:num)/edit', $controller . '::edit/$1');
            $routes->post('(:num)', $controller . '::update/$1');
            $routes->post('(:num)/delete', $controller . '::delete/$1');
            $routes->post('(:num)/toggle-status', $controller . '::toggleStatus/$1');
        });
    }

    // User Management
    $routes->group('users', ['filter' => 'permission:users.manage'], function (RouteCollection $routes) {
        $routes->get('/', 'UserController::index');
        $routes->get('create', 'UserController::create');
        $routes->post('/', 'UserController::store');
        $routes->get('(:num)/edit', 'UserController::edit/$1');
        $routes->post('(:num)', 'UserController::update/$1');
        $routes->post('(:num)/delete', 'UserController::delete/$1');
    });

    // Permission Management (read-only)
    $routes->group('permissions', ['filter' => 'permission:permissions.manage'], function (RouteCollection $routes) {
        $routes->get('/', 'PermissionController::index');
    });

    // Audit Log (read-only)
    $routes->group('audit-logs', ['filter' => 'permission:admin.access'], function (RouteCollection $routes) {
        $routes->get('/', 'AuditLogController::index');
    });

    // Backup Management
    $routes->group('backups', ['filter' => 'permission:backups.manage'], function (RouteCollection $routes) {
        $routes->get('/', 'BackupController::index');
        $routes->post('create', 'BackupController::create');
        $routes->get('(:any)/download', 'BackupController::download/$1');
        $routes->post('(:any)/delete', 'BackupController::delete/$1');
    });

    // Panduan Penggunaan (read-only, visible to every admin role)
    $routes->group('guide', ['filter' => 'permission:admin.access'], function (RouteCollection $routes) {
        $routes->get('/', 'GuideController::index');
    });
});
