<?php
$headerSite   = $site ?? (new \App\Services\SettingService())->getSite();
$productTypes = \App\Models\ProductModel::TYPES;
$exploreItems = [
    'insight'  => 'Baking Insight',
    'recipe'   => 'Recipe',
    'article'  => 'Article',
    'activity' => 'Activity',
];
$isHomePage = trim(service('uri')->getPath(), '/') === '';
?>
<div class="fixed inset-x-0 top-0 z-50 px-3 pt-3 sm:px-4 sm:pt-4" data-site-header-wrap>
    <header data-site-header data-page-type="<?= $isHomePage ? 'home' : 'inner' ?>" class="mx-auto max-w-site rounded-full border border-white/40 backdrop-blur-2xl shadow-lg transition-all duration-300">
        <div class="relative flex h-16 items-center justify-between gap-4 px-5 sm:h-[4.5rem] sm:px-7">
            <a href="<?= site_url('/') ?>" class="relative z-10 flex items-center gap-2 font-heading font-extrabold text-xl sm:text-2xl tracking-tight shrink-0">
                <?php if (! empty($headerSite['logo'])): ?>
                    <img src="<?= base_url($headerSite['logo']) ?>" alt="<?= esc($headerSite['companyName'] ?? 'PGA') ?>" class="h-12 w-auto object-contain sm:h-14">
                <?php else: ?>
                    <span class="text-primary">PGA</span>
                <?php endif; ?>
            </a>

            <div class="pointer-events-none absolute inset-x-16 top-1/2 -translate-y-1/2 text-center lg:hidden">
                <span class="block truncate font-heading font-bold text-xs sm:text-sm text-primary"><?= esc($headerSite['companyName'] ?? 'Pancaran Gemilang Abadi') ?></span>
            </div>

            <nav class="hidden lg:flex items-center gap-1">
                <a href="<?= site_url('/') ?>" class="nav-link">
                    <span>Home</span>
                    <svg viewBox="0 0 24 24" class="nav-link-icon h-3 w-3 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                </a>

                <div class="relative group">
                    <button type="button" class="nav-link inline-flex items-center gap-1">
                        Product
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current transition-transform duration-300 group-hover:rotate-180"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <?= view('components/mega-menu', ['items' => $productTypes, 'baseUrl' => 'product', 'param' => 'type']) ?>
                </div>

                <div class="relative group">
                    <button type="button" class="nav-link inline-flex items-center gap-1">
                        Explore
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current transition-transform duration-300 group-hover:rotate-180"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <?= view('components/mega-menu', ['items' => $exploreItems, 'baseUrl' => 'explore']) ?>
                </div>

                <a href="<?= site_url('about') ?>" class="nav-link">
                    <span>About</span>
                    <svg viewBox="0 0 24 24" class="nav-link-icon h-3 w-3 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                </a>
                <a href="<?= site_url('contact') ?>" class="nav-link">
                    <span>Contact</span>
                    <svg viewBox="0 0 24 24" class="nav-link-icon h-3 w-3 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                </a>
            </nav>

            <div class="relative z-10 flex items-center gap-2 sm:gap-3">
                <a href="<?= site_url('contact') ?>"
                   class="btn-icon hidden sm:inline-flex items-center gap-1.5 rounded-full bg-primary text-white text-sm font-bold px-5 py-2.5 hover:bg-primary-dark transition-colors shadow-md shadow-primary/20">
                    <span>Hubungi Kami</span>
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M3 5h18v14H3V5Zm2.2 2.2v.4l6.8 4.8 6.8-4.8v-.4H5.2Zm13.6 9.6V10l-6.1 4.3a1.2 1.2 0 0 1-1.4 0L5.2 10v6.8h13.6Z"/></svg>
                </a>
                <button type="button" id="mobile-menu-btn" class="lg:hidden inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 text-accent-black">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M3 6h18v2H3V6Zm0 5h18v2H3v-2Zm0 5h18v2H3v-2Z"/></svg>
                </button>
            </div>
        </div>
    </header>

    <div id="mobile-menu" class="hidden mx-auto mt-2 max-w-site rounded-2xl border border-gray-100 bg-white shadow-xl p-4 lg:hidden">
        <a href="<?= site_url('/') ?>" class="block py-2.5 text-sm font-bold text-primary">Home</a>
        <p class="mt-2 px-0 py-1 text-xs font-semibold uppercase tracking-wide text-gray-400">Product</p>
        <?php foreach ($productTypes as $key => $label): ?>
            <a href="<?= site_url('product?type=' . $key) ?>" class="block py-2 pl-3 text-sm text-gray-600"><?= esc($label) ?></a>
        <?php endforeach; ?>
        <p class="mt-2 px-0 py-1 text-xs font-semibold uppercase tracking-wide text-gray-400">Explore</p>
        <?php foreach ($exploreItems as $key => $label): ?>
            <a href="<?= site_url('explore/' . $key) ?>" class="block py-2 pl-3 text-sm text-gray-600"><?= esc($label) ?></a>
        <?php endforeach; ?>
        <a href="<?= site_url('about') ?>" class="block py-2.5 text-sm font-bold text-primary">About</a>
        <a href="<?= site_url('contact') ?>" class="block py-2.5 text-sm font-bold text-primary">Contact</a>
    </div>
</div>
