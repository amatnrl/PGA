<?= $this->extend('site/layouts/main') ?>

<?= $this->section('content') ?>
<?= view('site/partials/page-header', ['pageTitle' => $product['name'], 'pageSubtitle' => $typeLabel ?? '']) ?>

<div class="max-w-7xl mx-auto px-6 pt-10">
    <?= view('components/breadcrumb', ['breadcrumbs' => [
        ['label' => 'Home', 'url' => site_url('/')],
        ['label' => 'Product', 'url' => site_url('product')],
        ['label' => $typeLabel ?? '', 'url' => site_url('product?type=' . ($product['type'] ?? ''))],
        ['label' => $product['name']],
    ]]) ?>
</div>

<?php $gallery = array_merge($images, $resultImages); ?>
<section class="px-6 max-w-7xl mx-auto pb-20 grid grid-cols-1 lg:grid-cols-2 gap-12">
    <!-- Gallery -->
    <div>
        <?php $main = $gallery[0] ?? null; ?>
        <div class="product-gallery-main group relative aspect-square rounded-xl overflow-hidden bg-gray-50 mb-3">
            <img id="mainImage" src="<?= $main ? base_url($main['path']) : 'https://placehold.co/600x600?text=PGA' ?>"
                 data-lightbox-trigger data-full="<?= $main ? base_url($main['path']) : '' ?>"
                 class="h-full w-full object-cover cursor-zoom-in transition-transform duration-500 group-hover:scale-105">
            <span class="pointer-events-none absolute inset-0 flex items-center justify-center bg-black/0 opacity-0 transition-all duration-300 group-hover:bg-black/10 group-hover:opacity-100">
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-white/90 text-primary shadow-lg">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M10 4a6 6 0 1 0 3.8 10.6l4.3 4.3 1.4-1.4-4.3-4.3A6 6 0 0 0 10 4Zm0 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z"/></svg>
                </span>
            </span>
        </div>
        <?php if (count($gallery) > 1): ?>
            <div class="relative flex items-center gap-2">
                <?php if (count($gallery) > 5): ?>
                    <button type="button" class="carousel-arrow-btn !h-8 !w-8 shrink-0" data-scroll-target="gallery-thumbs" data-scroll-dir="prev" aria-label="Sebelumnya">
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M15 6l-6 6 6 6"/></svg>
                    </button>
                <?php endif; ?>
                <div id="gallery-thumbs" class="no-scrollbar flex flex-1 gap-2 overflow-x-auto scroll-smooth">
                    <?php foreach ($gallery as $i => $img): ?>
                        <img src="<?= base_url($img['path']) ?>" loading="lazy"
                             onclick="document.getElementById('mainImage').src=this.src;document.getElementById('mainImage').dataset.full=this.src;document.querySelectorAll('.gallery-thumb').forEach(t=>t.classList.remove('is-active'));this.classList.add('is-active');this.scrollIntoView({behavior:'smooth',inline:'start',block:'nearest'})"
                             class="gallery-thumb w-[calc((100%-2rem)/5)] shrink-0 aspect-square object-cover rounded-lg cursor-pointer border-2 transition-all duration-200 hover:opacity-90 <?= $i === 0 ? 'is-active border-primary' : 'border-gray-100' ?>">
                    <?php endforeach; ?>
                </div>
                <?php if (count($gallery) > 5): ?>
                    <button type="button" class="carousel-arrow-btn !h-8 !w-8 shrink-0" data-scroll-target="gallery-thumbs" data-scroll-dir="next" aria-label="Berikutnya">
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M9 6l6 6-6 6"/></svg>
                    </button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Info -->
    <div>
        <span class="text-xs font-semibold text-primary uppercase"><?= esc($typeLabel ?? '') ?></span>
        <h1 class="font-heading font-extrabold text-3xl mt-1 mb-6"><?= esc($product['name']) ?></h1>

        <?php if ($product['description']): ?>
            <h3 class="font-heading font-semibold text-sm mb-2">Deskripsi Produk</h3>
            <div class="prose prose-sm text-gray-600 max-w-none mb-6"><?= $product['description'] ?></div>
        <?php endif; ?>

        <?php
        $marketIcons = [
            'shopee'    => '<path d="M7 8V6.5a5 5 0 0 1 10 0V8h2.2L20 20H4l.8-12H7Zm2-1.5V8h6V6.5a3 3 0 0 0-6 0ZM9 10v1.5a1 1 0 1 0 2 0V10H9Zm4 0v1.5a1 1 0 1 0 2 0V10h-2Z"/>',
            'tokopedia' => '<path d="M4 4h16l1.2 5H2.8L4 4Zm-.6 6h17.2l-.8 10H4.2l-.8-10Zm5.1 2v4h2v-4h-2Zm6 0v4h2v-4h-2Z"/>',
            'tiktok'    => '<path d="M16.7 3h-2.9v12.4a2.5 2.5 0 1 1-1.8-2.4v-3a5.5 5.5 0 1 0 4.7 5.4V9.1a6.9 6.9 0 0 0 4 1.3V7.5a4 4 0 0 1-4-4.5Z"/>',
        ];
        ?>
        <div>
            <h3 class="font-heading font-semibold text-sm mb-3">Hubungi &amp; Beli Via</h3>
            <div class="flex flex-wrap gap-3">
                <a href="<?= $waLink ?>" target="_blank" rel="noopener" class="marketplace-btn group">
                    <span class="marketplace-btn-icon">
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M17.5 14.4c-.7-.3-1.6-.8-2.3-.4-.4.2-.7.9-1 1.3-.2.3-.5.3-.9.2-2-.8-3.6-2.4-4.4-4.4-.1-.4-.1-.7.2-.9.4-.3 1.1-.6 1.3-1 .4-.7-.1-1.6-.4-2.3-.3-.7-.6-1.5-1.3-1.7-.7-.2-1.6.1-2.1.6-1 1-1.2 2.6-.8 4 .8 3.2 3.5 6.6 6.7 7.9 1.4.6 3.1.7 4.3-.3.6-.5 1.1-1.3.9-2.1-.2-.6-1-1-1.2-.9Z"/></svg>
                    </span>
                    <span>Minta Penawaran</span>
                    <svg viewBox="0 0 24 24" class="marketplace-btn-arrow h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                </a>
                <?php foreach ($marketplace as $link): ?>
                    <a href="<?= esc($link['url']) ?>" target="_blank" rel="noopener" class="marketplace-btn group">
                        <span class="marketplace-btn-icon">
                            <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><?= $marketIcons[$link['platform']] ?? '<circle cx="12" cy="12" r="9"/>' ?></svg>
                        </span>
                        <span>Beli di <?= esc(ucfirst($link['platform'])) ?></span>
                        <svg viewBox="0 0 24 24" class="marketplace-btn-arrow h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php if (! empty($relatedRecipes)): ?>
<section class="px-6 max-w-7xl mx-auto pb-20">
    <div class="flex items-center justify-between mb-8" data-aos="fade-up">
        <h2 class="font-heading font-bold text-2xl">Resep Terkait</h2>
        <?php if (count($relatedRecipes) > 4): ?>
            <div class="hidden sm:flex items-center gap-2 shrink-0">
                <button type="button" class="carousel-arrow-btn" data-scroll-target="recipe-carousel" data-scroll-dir="prev" aria-label="Sebelumnya">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M15 6l-6 6 6 6"/></svg>
                </button>
                <button type="button" class="carousel-arrow-btn" data-scroll-target="recipe-carousel" data-scroll-dir="next" aria-label="Berikutnya">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M9 6l6 6-6 6"/></svg>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <p class="text-sm text-gray-500 -mt-6 mb-6">Resep yang menggunakan <?= esc($product['name']) ?>.</p>
    <div id="recipe-carousel" class="recipe-carousel no-scrollbar flex gap-5 overflow-x-auto scroll-smooth snap-x snap-mandatory py-8">
        <?php foreach ($relatedRecipes as $rc): ?>
            <div class="recipe-card-wrap relative w-[46%] shrink-0 snap-start sm:w-[31%] lg:w-[23.5%]">
                <span class="recipe-card-ghost"></span>
                <?= view('components/content-card', ['item' => $rc, 'baseUrl' => 'explore/recipe']) ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<?php if (! empty($related)): ?>
<section class="px-6 max-w-7xl mx-auto pb-20">
    <div class="flex items-center justify-between mb-8" data-aos="fade-up">
        <h2 class="font-heading font-bold text-2xl">Produk Terkait</h2>
        <?php if (count($related) > 4): ?>
            <div class="hidden sm:flex items-center gap-2 shrink-0">
                <button type="button" class="carousel-arrow-btn" data-scroll-target="related-carousel" data-scroll-dir="prev" aria-label="Sebelumnya">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M15 6l-6 6 6 6"/></svg>
                </button>
                <button type="button" class="carousel-arrow-btn" data-scroll-target="related-carousel" data-scroll-dir="next" aria-label="Berikutnya">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M9 6l6 6-6 6"/></svg>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div id="related-carousel" class="no-scrollbar flex gap-5 overflow-x-auto scroll-smooth snap-x snap-mandatory py-5">
        <?php foreach ($related as $r): ?>
            <div class="w-[46%] shrink-0 snap-start sm:w-[31%] lg:w-[23.5%]">
                <?= view('components/product-card', ['product' => $r]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>
<?= $this->endSection() ?>
