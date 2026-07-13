<?= $this->extend('site/layouts/main') ?>

<?= $this->section('content') ?>
<?= view('site/partials/page-header', ['pageTitle' => 'Produk Kami', 'pageSubtitle' => 'Bahan baku makanan dan minuman berkualitas untuk bisnis Anda.']) ?>

<div class="max-w-7xl mx-auto px-6 pt-10">
    <?= view('components/breadcrumb', ['breadcrumbs' => [['label' => 'Home', 'url' => site_url('/')], ['label' => 'Product']]]) ?>
</div>

<section class="px-6 max-w-7xl mx-auto pb-20">
    <div class="flex flex-col sm:flex-row gap-8">
        <aside class="w-full sm:w-60 shrink-0">
            <h3 class="font-heading font-semibold text-sm mb-3">Jenis Produk</h3>
            <ul class="space-y-2">
                <?php
                $isAll = empty($_GET['type']);
                $qs    = ! empty($_GET['q']) ? '&q=' . rawurlencode($_GET['q']) : '';
                ?>
                <li>
                    <a href="<?= site_url('product' . ($qs !== '' ? '?' . substr($qs, 1) : '')) ?>" class="type-filter-link <?= $isAll ? 'is-active' : '' ?>">
                        <span class="type-filter-icon">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M4 4h7v7H4V4Zm9 0h7v7h-7V4ZM4 13h7v7H4v-7Zm9 0h7v7h-7v-7Z"/></svg>
                        </span>
                        <span class="flex-1">Semua Produk</span>
                        <svg viewBox="0 0 24 24" class="type-filter-arrow h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                    </a>
                </li>
                <?php foreach ($types as $key => $label): ?>
                    <?php $active = ($_GET['type'] ?? '') === $key; ?>
                    <li>
                        <a href="<?= site_url('product?type=' . $key . $qs) ?>" class="type-filter-link <?= $active ? 'is-active' : '' ?>">
                            <span class="type-filter-icon">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="m12 2.8 8.5 4.4v9.6L12 21.2 3.5 16.8V7.2L12 2.8Zm0 2.5-5.8 3 5.8 3 5.8-3-5.8-3Zm-6 5.1v5l5 2.6v-5l-5-2.6Zm7.4 7.6 5-2.6v-5l-5 2.6v5Z"/></svg>
                            </span>
                            <span class="flex-1"><?= esc($label) ?></span>
                            <svg viewBox="0 0 24 24" class="type-filter-arrow h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <div class="flex-1">
            <form method="get" class="product-search relative mb-8" data-aos="fade-up">
                <?php if (! empty($_GET['type'])): ?>
                    <input type="hidden" name="type" value="<?= esc($_GET['type']) ?>">
                <?php endif; ?>
                <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 fill-current text-gray-400"><path d="m21 21-4.3-4.3m1.8-5.2a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                <input type="text" name="q" value="<?= esc($_GET['q'] ?? '') ?>" placeholder="Cari nama produk..." class="product-search-input w-full rounded-full border border-gray-200 py-3 pl-12 pr-24 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
                <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 rounded-full bg-primary px-5 py-2 text-xs font-bold text-white transition-colors hover:bg-primary-dark">Cari</button>
            </form>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-5 gap-y-8">
                <?php foreach ($products as $i => $product): ?>
                    <div data-aos="fade-up" data-aos-delay="<?= ($i % 4) * 80 ?>">
                        <?= view('components/product-card', ['product' => $product]) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (empty($products)): ?>
                <p class="text-center text-gray-400 py-16">Produk tidak ditemukan.</p>
            <?php endif; ?>
            <div class="mt-8"><?= $pager->links() ?></div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
