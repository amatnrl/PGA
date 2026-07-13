<?php
/**
 * @var array  $item    row with title, slug, excerpt, featured_image
 * @var string $baseUrl  e.g. 'explore/insight'
 */
?>
<a href="<?= site_url($baseUrl . '/' . $item['slug']) ?>"
   class="content-card group relative block bg-white rounded-2xl border border-gray-100 overflow-hidden"
   data-aos="fade-up">
    <div class="relative aspect-[4/3] overflow-hidden bg-gray-50">
        <img src="<?= ! empty($item['featured_image']) ? base_url($item['featured_image']) : 'https://placehold.co/400x300?text=PGA' ?>"
             alt="<?= esc($item['title']) ?>" loading="lazy"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
        <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <span class="absolute right-3 top-3 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-primary opacity-0 -translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 shadow-md">
            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M6 18 18 6M9 6h9v9"/></svg>
        </span>
    </div>
    <div class="p-4 relative">
        <span class="absolute -top-2 left-4 h-1 w-8 rounded-full bg-primary scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
        <h3 class="font-heading font-semibold text-sm line-clamp-2 group-hover:text-primary transition-colors"><?= esc($item['title']) ?></h3>
        <?php if (! empty($item['excerpt'])): ?>
            <p class="text-xs text-gray-500 mt-1 line-clamp-2"><?= esc($item['excerpt']) ?></p>
        <?php endif; ?>
    </div>
</a>
