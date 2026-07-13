<section class="relative w-screen" data-hero-flush>
    <?php if (! empty($banners)): ?>
        <div class="hero-swiper swiper relative aspect-[16/9] w-full sm:aspect-auto sm:h-screen">
            <div class="swiper-wrapper">
                <?php foreach ($banners as $i => $b): ?>
                    <div class="swiper-slide relative">
                        <div class="relative aspect-[16/9] w-full sm:aspect-auto sm:h-screen">
                            <img src="<?= base_url($b['image']) ?>" alt="Banner PGA" <?= $i === 0 ? '' : 'loading="lazy"' ?> class="absolute inset-0 h-full w-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="hero-pagination swiper-pagination !bottom-4 sm:!bottom-9"></div>
        </div>
    <?php else: ?>
        <div class="flex aspect-[16/9] items-center justify-center bg-gradient-to-br from-accent-black via-primary-dark to-primary sm:aspect-auto sm:h-screen"></div>
    <?php endif; ?>
</section>
