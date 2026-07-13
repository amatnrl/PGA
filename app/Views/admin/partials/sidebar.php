<?php
$menuGroups   = \App\Libraries\AdminMenu::groups();
$sidebarSite  = $site ?? (new \App\Services\SettingService())->getSite();

$icon = static function (string $name): string {
    $icons = [
        'dashboard' => '<path d="M3 13.2h8.2V3H3v10.2Zm0 7.8h8.2v-5.8H3V21Zm10.8 0H22V10.8h-8.2V21Zm0-17.8v5.6H22V3.2h-8.2Z"/>',
        'home' => '<path d="M12 3 2.5 10.2l1.4 1.9L5 11.3V21h14v-9.7l1.1.8 1.4-1.9L12 3Zm5.5 15.5h-11v-8.9L12 5.7l5.5 3.9v8.9Z"/>',
        'chart' => '<path d="M4 20.5h16v-2.2H4v2.2Zm1.8-4.8h2.5V9.1H5.8v6.6Zm4.9 0h2.5V5.8h-2.5v9.9Zm4.9 0h2.5V11h-2.5v4.7Z"/>',
        'box' => '<path d="m12 2.8 8.5 4.4v9.6L12 21.2 3.5 16.8V7.2L12 2.8Zm0 2.5-5.8 3 5.8 3 5.8-3-5.8-3Zm-6 5.1v5l5 2.6v-5l-5-2.6Zm7.4 7.6 5-2.6v-5l-5 2.6v5Z"/>',
        'folder' => '<path d="M3 6.2h7l1.8 2H21v9.6A2.2 2.2 0 0 1 18.8 20H5.2A2.2 2.2 0 0 1 3 17.8V6.2Zm2.2 2.2v9.4h13.6v-7.4h-8l-1.8-2H5.2Z"/>',
        'insight' => '<path d="M11 3h2v8h-2V3Zm0 10h2v2h-2v-2Zm1 8.5A8.5 8.5 0 1 1 12 4a8.5 8.5 0 0 1 0 17.5Zm0-2.3a6.2 6.2 0 1 0 0-12.4 6.2 6.2 0 0 0 0 12.4Z"/>',
        'recipe' => '<path d="M6 3h12v18H6V3Zm2.2 2.2v13.6h7.6V5.2H8.2Zm1.3 2.1h5v2h-5v-2Zm0 3.6h5v2h-5v-2Z"/>',
        'article' => '<path d="M4 4h16v16H4V4Zm2.2 2.2v11.6h11.6V6.2H6.2Zm1.6 2h8.4v2H7.8v-2Zm0 3.6h8.4v2H7.8v-2Z"/>',
        'activity' => '<path d="M3 12h4l2-4 3 8 2-4h7v2.2h-5.6l-3.1 6.2-3-8-1.3 2.6H3V12Z"/>',
        'media' => '<path d="M4 5h16v14H4V5Zm2.2 2.2v9.6h11.6V7.2H6.2Zm2.2 7.2 2.3-2.8 1.8 2.2 2.6-3.2 2.7 3.8H8.4Z"/>',
        'banner' => '<path d="M4 5h16v10H8l-4 4V5Zm2.2 2.2v6.6h11.6V7.2H6.2Z"/>',
        'faq' => '<path d="M12 2.8a9.2 9.2 0 1 1 0 18.4A9.2 9.2 0 0 1 12 2.8Zm0 2.2a7 7 0 1 0 0 14 7 7 0 0 0 0-14Zm-1.2 9.8h2.4v2.3h-2.4v-2.3Zm0-7h2.4c1.9 0 3.2 1.2 3.2 3 0 1.4-.8 2.3-1.9 2.9-.7.4-1.1.7-1.1 1.4v.4h-2.2v-.7c0-1.7.8-2.6 2-3.3.7-.4 1-.7 1-1.1 0-.6-.4-1-1.1-1h-2.3V7.8Z"/>',
        'partner' => '<path d="M7.2 5.2A3.2 3.2 0 1 1 7.2 11.6 3.2 3.2 0 0 1 7.2 5.2Zm9.6 0A3.2 3.2 0 1 1 16.8 11.6 3.2 3.2 0 0 1 16.8 5.2ZM4 18.2c0-2.1 1.7-3.8 3.8-3.8h2.4c2.1 0 3.8 1.7 3.8 3.8V20H4v-1.8Zm10 0c0-2.1 1.7-3.8 3.8-3.8h.2c2.1 0 3.8 1.7 3.8 3.8V20H14v-1.8Z"/>',
        'star' => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1 6.2L12 17.3l-5.5 2.9 1-6.2L3 9.6l6.2-.9L12 3Z"/>',
        'mail' => '<path d="M3 5h18v14H3V5Zm2.2 2.2v.4l6.8 4.8 6.8-4.8v-.4H5.2Zm13.6 9.6V10l-6.1 4.3a1.2 1.2 0 0 1-1.4 0L5.2 10v6.8h13.6Z"/>',
        'user' => '<path d="M12 3.5a4.3 4.3 0 1 1 0 8.6 4.3 4.3 0 0 1 0-8.6Zm0 10.8c4.2 0 7.6 2.4 7.6 5.4V21H4.4v-1.3c0-3 3.4-5.4 7.6-5.4Z"/>',
        'lock' => '<path d="M7 10V7.8A5 5 0 0 1 17 7.8V10h1.5v11h-13V10H7Zm2.2 0h5.6V7.8a2.8 2.8 0 0 0-5.6 0V10Zm2.8 3a2.2 2.2 0 0 1 1.2 4v2.5h-2.4V17a2.2 2.2 0 0 1 1.2-4Z"/>',
        'database' => '<path d="M12 3c4.7 0 8 1.7 8 4v10c0 2.3-3.3 4-8 4s-8-1.7-8-4V7c0-2.3 3.3-4 8-4Zm0 2.3c-3.6 0-5.8 1.1-5.8 1.7S8.4 8.7 12 8.7 17.8 7.6 17.8 7 15.6 5.3 12 5.3Zm0 6c-3.1 0-5.4-.8-6.8-1.9V11c0 .6 2.2 1.7 6.8 1.7s6.8-1.1 6.8-1.7V9.4c-1.4 1.1-3.7 1.9-6.8 1.9Zm0 5.7c-3.1 0-5.4-.8-6.8-1.9V17c0 .6 2.2 1.7 6.8 1.7s6.8-1.1 6.8-1.7v-1.9c-1.4 1.1-3.7 1.9-6.8 1.9Z"/>',
        'settings' => '<path d="m19.4 13.3 1.6-1.2-1.6-2.8-2 .4a6.4 6.4 0 0 0-1.1-.7l-.3-2h-3.2l-.3 2c-.4.2-.8.4-1.2.7l-2-.4L3.7 12l1.6 1.3c0 .4 0 .8.1 1.1l-1.7 1.3 1.6 2.8 2-.4c.4.3.8.5 1.2.7l.3 2h3.2l.3-2c.4-.2.8-.4 1.2-.7l2 .4 1.6-2.8-1.6-1.2c.1-.4.1-.8.1-1.2ZM12 15.6a3.4 3.4 0 1 1 0-6.8 3.4 3.4 0 0 1 0 6.8Z"/>',
        'branch' => '<path d="M6 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM18 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM12 15a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM7 7.8l3.8 6.4-1.9 1.1L5.1 9 7 7.8Zm10 0L18.9 9l-3.8 6.3-1.9-1.1L17 7.8Z"/>',
        'guide' => '<path d="M4 4.8c2.6-1.2 5.4-1.1 8 .3v13.1c-2.6-1.3-5.4-1.4-8-.3V4.8Zm16 0v12.8c-2.6-1.1-5.4-1-8 .3V5.1c2.6-1.4 5.4-1.5 8-.3ZM11 6.7c-2-.8-4-.9-5.8-.2v9.6c1.8-.5 3.8-.4 5.8.4V6.7Z"/>',
    ];

    return $icons[$name] ?? '<circle cx="12" cy="12" r="8"/>';
};

$path = trim(parse_url(current_url(), PHP_URL_PATH) ?? '', '/');
$path = preg_replace('#^index\.php/#', '', $path);

$isActive = function (string $url) use ($path): bool {
    $url = trim($url, '/');
    if ($url === 'admin') {
        return $path === 'admin';
    }
    return $path === $url || str_starts_with($path, $url . '/');
};
?>

<div id="sidebar-backdrop" class="sidebar-backdrop fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden"></div>

<aside id="admin-sidebar" aria-hidden="true" class="admin-sidebar fixed inset-y-0 left-0 z-50 flex w-[18.5rem] -translate-x-full flex-col border-r border-slate-200/70 bg-white/95 shadow-2xl transition-[transform,width] duration-300 ease-out lg:sticky lg:top-0 lg:z-20 lg:h-screen lg:w-80 lg:translate-x-0 lg:shadow-none">
    <div class="flex h-16 shrink-0 items-center justify-between border-b border-slate-200/70 px-5">
        <a href="<?= site_url('admin') ?>" class="sidebar-brand flex items-center gap-3 overflow-hidden">
            <?php if (! empty($sidebarSite['logo'])): ?>
                <div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200">
                    <img src="<?= base_url($sidebarSite['logo']) ?>" alt="<?= esc($sidebarSite['companyName'] ?? 'PGA') ?>" class="h-full w-full object-contain">
                </div>
            <?php else: ?>
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-red-600 via-red-500 to-rose-600 text-sm font-extrabold text-white shadow-lg shadow-red-500/30">PGA</div>
            <?php endif; ?>
            <div class="sidebar-brand-text min-w-0">
                <p class="truncate text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Enterprise CMS</p>
                <p class="truncate text-sm font-semibold text-slate-900">Pancaran Gemilang Abadi</p>
            </div>
        </a>
        <button id="sidebar-close-btn" type="button" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-slate-200 text-red-600 transition hover:bg-red-50 hover:text-red-700 lg:hidden" aria-label="Close sidebar">
            <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current">
                <path d="m13.6 12 5.3-5.3-1.6-1.6-5.3 5.3-5.3-5.3-1.6 1.6L10.4 12l-5.3 5.3 1.6 1.6 5.3-5.3 5.3 5.3 1.6-1.6-5.3-5.3Z" />
            </svg>
        </button>
    </div>

    <nav class="admin-scrollbar flex-1 space-y-5 overflow-y-auto px-3 py-4">
        <?php foreach ($menuGroups as $group): ?>
            <section>
                <p class="sidebar-group-label px-2 pb-2 text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-slate-400"><?= esc($group['label']) ?></p>
                <div class="space-y-1.5">
                    <?php foreach ($group['items'] as $item): ?>
                        <?php $active = $isActive($item['url']); ?>
                        <a href="<?= site_url($item['url']) ?>" class="sidebar-link group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition <?= $active ? 'bg-red-50 text-red-700 ring-1 ring-red-200' : 'text-slate-600 hover:bg-slate-100/90 hover:text-slate-900' ?>">
                            <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg <?= $active ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-500 group-hover:bg-white group-hover:text-slate-700' ?>">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><?= $icon($item['icon']) ?></svg>
                            </span>
                            <span class="sidebar-label truncate"><?= esc($item['label']) ?></span>
                            <span class="sidebar-tooltip pointer-events-none absolute left-full top-1/2 z-50 ml-3 hidden -translate-y-1/2 whitespace-nowrap rounded-lg bg-slate-900 px-2.5 py-1.5 text-xs font-medium text-white opacity-0 shadow-lg transition-opacity duration-150 group-hover:opacity-100"><?= esc($item['label']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </nav>

    <div class="shrink-0 border-t border-slate-200/70 p-4">
        <a href="<?= site_url('/') ?>" target="_blank" class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-slate-600 transition hover:border-slate-300 hover:text-slate-900">
            <svg viewBox="0 0 24 24" class="h-4 w-4 shrink-0 fill-current">
                <path d="M14 4h6v6h-2.2V7.8l-7.1 7.1-1.5-1.6 7.1-7.1H14V4ZM5 6h6v2.2H7.2v8.6h8.6v-3.8H18V19H5V6Z" />
            </svg>
            <span class="sidebar-footer-text">Buka Website</span>
        </a>
    </div>
</aside>
