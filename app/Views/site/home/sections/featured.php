<?php
if (empty($featured)) {
    return;
}
$heading    = hv($home, 'featuredHeading', 'Produk Unggulan Kami');
$subheading = hv($home, 'featuredSubheading', 'Pilihan produk terbaik dan terlaris dari PGA.');
?>
<section class="relative overflow-hidden bg-white py-20 px-6">
    <div class="section-motif bg-motif-dots-dark opacity-30"></div>
    <div class="relative mx-auto max-w-site">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between mb-8" data-aos="fade-up">
            <div>
                <h2 class="font-heading font-bold text-3xl md:text-4xl"><?= esc($heading) ?></h2>
                <p class="text-gray-500 mt-2"><?= esc($subheading) ?></p>
            </div>
            <a href="<?= site_url('product') ?>" class="btn-icon hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline whitespace-nowrap">
                <span>Lihat Semua</span>
                <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
            </a>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 mb-8" data-aos="fade-up" data-aos-delay="80">
            <div class="flex flex-wrap gap-2">
                <button type="button" data-featured-tab="all" class="featured-tab-btn is-active">Semua Produk</button>
                <?php foreach ($productTypes as $key => $label): ?>
                    <button type="button" data-featured-tab="<?= esc($key) ?>" class="featured-tab-btn"><?= esc($label) ?></button>
                <?php endforeach; ?>
            </div>
            <div class="hidden sm:flex items-center gap-2 shrink-0">
                <button type="button" class="carousel-arrow-btn" data-scroll-target="featured-carousel" data-scroll-dir="prev" aria-label="Sebelumnya">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M15 6l-6 6 6 6"/></svg>
                </button>
                <button type="button" class="carousel-arrow-btn" data-scroll-target="featured-carousel" data-scroll-dir="next" aria-label="Berikutnya">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M9 6l6 6-6 6"/></svg>
                </button>
            </div>
        </div>

        <div id="featured-carousel" class="no-scrollbar flex gap-5 overflow-x-auto scroll-smooth snap-x snap-mandatory py-5">
            <?php foreach ($featured as $i => $product): ?>
                <div data-featured-card data-type="<?= esc($product['type']) ?>" class="w-[calc(50%-10px)] shrink-0 snap-start sm:w-[31%] lg:w-[23.5%]" data-aos="fade-up" data-aos-delay="<?= ($i % 4) * 80 ?>">
                    <?= view('components/product-card', ['product' => $product]) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-8 text-center sm:hidden">
            <a href="<?= site_url('product') ?>" class="text-sm font-semibold text-primary hover:underline">Lihat Semua Produk &rarr;</a>
        </div>
    </div>
</section>
