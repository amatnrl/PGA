<?php
/**
 * Shared "Jenis Explore" sidebar: search box, type switcher, archives.
 *
 * @var array       $types       typeKey => ['label' => ..., 'baseUrl' => ...]
 * @var string      $typeKey     active type key
 * @var array       $archives    [['year','month','label','total']]
 * @var string|null $activeMonth
 * @var string|null $activeYear
 * @var string|null $q
 */
$currentBaseUrl = $types[$typeKey]['baseUrl'] ?? 'explore';
?>
<aside class="w-full lg:w-72 shrink-0 space-y-6" data-aos="fade-up">
    <form method="get" action="<?= site_url($currentBaseUrl) ?>" class="product-search relative">
        <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-4 top-1/2 h-[18px] w-[18px] -translate-y-1/2 fill-none stroke-current text-gray-400" stroke-width="2"><path d="m21 21-4.3-4.3m1.8-5.2a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
        <input type="text" name="q" value="<?= esc($q ?? '') ?>" placeholder="Cari di <?= esc($types[$typeKey]['label'] ?? 'Explore') ?>..." class="product-search-input w-full rounded-full border border-gray-200 py-2.5 pl-11 pr-16 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20">
        <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 rounded-full bg-primary px-4 py-1.5 text-xs font-bold text-white transition-colors hover:bg-primary-dark">Cari</button>
    </form>

    <div>
        <h3 class="font-heading font-semibold text-sm mb-3">Jenis Explore</h3>
        <div class="space-y-1 rounded-2xl border border-gray-100 bg-white p-2">
            <?php foreach ($types as $key => $t): ?>
                <a href="<?= site_url($t['baseUrl']) ?>" class="explore-type-link <?= $key === $typeKey ? 'is-active' : '' ?>">
                    <?= esc($t['label']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (! empty($archives)): ?>
        <div>
            <h3 class="font-heading font-semibold text-sm mb-3">Archives</h3>
            <div class="max-h-72 space-y-0.5 overflow-y-auto rounded-2xl border border-gray-100 bg-white p-2">
                <?php if (! empty($activeMonth) || ! empty($activeYear)): ?>
                    <a href="<?= site_url($currentBaseUrl . (! empty($q) ? '?q=' . rawurlencode($q) : '')) ?>" class="archive-link">
                        <span>&larr; Lihat Semua</span>
                    </a>
                <?php endif; ?>
                <?php foreach ($archives as $a): ?>
                    <?php
                    $isActive = (string) $a['month'] === (string) $activeMonth && (string) $a['year'] === (string) $activeYear;
                    $params   = ['month' => $a['month'], 'year' => $a['year']];
                    if (! empty($q)) {
                        $params['q'] = $q;
                    }
                    ?>
                    <a href="<?= site_url($currentBaseUrl . '?' . http_build_query($params)) ?>" class="archive-link <?= $isActive ? 'is-active' : '' ?>">
                        <span><?= esc($a['label']) ?></span>
                        <span class="archive-link-count"><?= (int) $a['total'] ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</aside>
