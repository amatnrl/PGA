<?php
/**
 * Horizontal explore listing card (Baking Insight / Recipe / Article / Activity):
 * image left, meta (updated by + date), truncated excerpt, "Read More" CTA.
 *
 * @var array  $item    row with title, slug, content, featured_image, updated_by, published_at
 * @var string $baseUrl e.g. 'explore/insight'
 */
$excerptSource = ! empty($item['excerpt']) ? $item['excerpt'] : strip_tags((string) ($item['content'] ?? ''));
$excerptSource = trim(preg_replace('/\s+/', ' ', $excerptSource));
$maxChars      = 130;
$excerpt       = mb_strlen($excerptSource) > $maxChars
    ? mb_substr($excerptSource, 0, $maxChars) . '…'
    : $excerptSource;
?>
<div class="explore-card-wrap group relative">
    <span class="explore-card-ghost"></span>
    <a href="<?= site_url($baseUrl . '/' . $item['slug']) ?>" class="explore-card relative z-10 flex gap-4 overflow-hidden rounded-2xl border border-gray-100 bg-white p-4">
        <div class="aspect-square w-28 shrink-0 overflow-hidden rounded-xl bg-gray-50 sm:w-36">
            <img src="<?= ! empty($item['featured_image']) ? base_url($item['featured_image']) : 'https://placehold.co/300x300?text=PGA' ?>"
                 alt="<?= esc($item['title']) ?>" loading="lazy"
                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
        </div>
        <div class="flex flex-1 flex-col min-w-0">
            <h3 class="font-heading font-semibold text-sm sm:text-base line-clamp-2 group-hover:text-primary transition-colors"><?= esc($item['title']) ?></h3>

            <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] text-gray-400">
                <span class="inline-flex items-center gap-1">
                    <svg viewBox="0 0 24 24" class="h-3 w-3 fill-current"><path d="M12 3.5a4.3 4.3 0 1 1 0 8.6 4.3 4.3 0 0 1 0-8.6Zm0 10.8c4.2 0 7.6 2.4 7.6 5.4V21H4.4v-1.3c0-3 3.4-5.4 7.6-5.4Z"/></svg>
                    <?= esc($item['updated_by'] ?? 'Admin') ?>
                </span>
                <?php if (! empty($item['published_at'])): ?>
                    <span class="inline-flex items-center gap-1">
                        <svg viewBox="0 0 24 24" class="h-3 w-3 fill-current"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7ZM3 10v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10H3Z"/></svg>
                        <?= esc(date('d M Y', strtotime($item['published_at']))) ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if ($excerpt !== ''): ?>
                <p class="mt-2 flex-1 text-xs text-gray-500 leading-relaxed line-clamp-2 sm:line-clamp-3"><?= esc($excerpt) ?></p>
            <?php endif; ?>

            <span class="explore-read-more btn-icon mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-primary">
                <span>Read More</span>
                <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
            </span>
        </div>
    </a>
</div>
