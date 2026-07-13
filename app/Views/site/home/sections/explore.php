<?php
if (empty($insightHighlights)) {
    return;
}
$heading    = hv($home, 'exploreHeading', 'Inspirasi Baking Insight Terkini');
$subheading = hv($home, 'exploreSubheading', 'Tips, wawasan, dan inspirasi seputar dunia baking dari PGA.');
?>
<section class="relative overflow-hidden bg-white py-20 px-6">
    <div class="section-motif bg-motif-dots-dark opacity-30"></div>
    <div class="relative mx-auto max-w-site">
        <div class="flex items-end justify-between mb-8 gap-4" data-aos="fade-up">
            <div>
                <h2 class="font-heading font-bold text-3xl md:text-4xl"><?= esc($heading) ?></h2>
                <p class="text-gray-500 mt-2"><?= esc($subheading) ?></p>
            </div>
            <div class="hidden sm:flex items-center gap-2 shrink-0">
                <button type="button" class="carousel-arrow-btn" data-scroll-target="insight-carousel" data-scroll-dir="prev" aria-label="Sebelumnya">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M15 6l-6 6 6 6"/></svg>
                </button>
                <button type="button" class="carousel-arrow-btn" data-scroll-target="insight-carousel" data-scroll-dir="next" aria-label="Berikutnya">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M9 6l6 6-6 6"/></svg>
                </button>
            </div>
        </div>
        <div id="insight-carousel" class="no-scrollbar flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory py-5">
            <?php foreach ($insightHighlights as $i => $item): ?>
                <div class="w-[85%] shrink-0 snap-start sm:w-[46%] lg:w-[31%]" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
                    <?= view('components/explore-card', ['item' => $item, 'baseUrl' => 'explore/insight']) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-8 text-center">
            <a href="<?= site_url('explore/insight') ?>" class="btn-icon inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
                <span>Lihat Semua</span>
                <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
            </a>
        </div>
    </div>
</section>
