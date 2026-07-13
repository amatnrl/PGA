<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
$cards = [
    [
        'label' => 'Total Produk',
        'value' => $counters['products'] ?? 0,
        'tone'  => 'cyan',
        'icon'  => '<path d="m12 2.8 8.5 4.4v9.6L12 21.2 3.5 16.8V7.2L12 2.8Zm0 2.5-5.8 3 5.8 3 5.8-3-5.8-3Zm-6 5.1v5l5 2.6v-5l-5-2.6Zm7.4 7.6 5-2.6v-5l-5 2.6v5Z"/>',
    ],
    [
        'label' => 'Total Insight',
        'value' => $counters['insights'] ?? 0,
        'tone'  => 'indigo',
        'icon'  => '<path d="M11 3h2v8h-2V3Zm0 10h2v2h-2v-2Zm1 8.5A8.5 8.5 0 1 1 12 4a8.5 8.5 0 0 1 0 17.5Zm0-2.3a6.2 6.2 0 1 0 0-12.4 6.2 6.2 0 0 0 0 12.4Z"/>',
    ],
    [
        'label' => 'Total Recipe',
        'value' => $counters['recipes'] ?? 0,
        'tone'  => 'amber',
        'icon'  => '<path d="M6 3h12v18H6V3Zm2.2 2.2v13.6h7.6V5.2H8.2Zm1.3 2.1h5v2h-5v-2Zm0 3.6h5v2h-5v-2Z"/>',
    ],
    [
        'label' => 'Total Article',
        'value' => $counters['articles'] ?? 0,
        'tone'  => 'violet',
        'icon'  => '<path d="M4 4h16v16H4V4Zm2.2 2.2v11.6h11.6V6.2H6.2Zm1.6 2h8.4v2H7.8v-2Zm0 3.6h8.4v2H7.8v-2Z"/>',
    ],
    [
        'label' => 'Total Activity',
        'value' => $counters['activities'] ?? 0,
        'tone'  => 'emerald',
        'icon'  => '<path d="M3 12h4l2-4 3 8 2-4h7v2.2h-5.6l-3.1 6.2-3-8-1.3 2.6H3V12Z"/>',
    ],
    [
        'label' => 'Total Visitor',
        'value' => $counters['visitors'] ?? 0,
        'tone'  => 'sky',
        'icon'  => '<path d="M12 5C6.5 5 2.2 8.3 1 12c1.2 3.7 5.5 7 11 7s9.8-3.3 11-7c-1.2-3.7-5.5-7-11-7Zm0 11.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9Zm0-2.2a2.3 2.3 0 1 0 0-4.6 2.3 2.3 0 0 0 0 4.6Z"/>',
    ],
    [
        'label' => 'Total Jalur Distribusi',
        'value' => $counters['branches'] ?? 0,
        'tone'  => 'rose',
        'icon'  => '<path d="M6 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM18 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM12 15a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM7 7.8l3.8 6.4-1.9 1.1L5.1 9 7 7.8Zm10 0L18.9 9l-3.8 6.3-1.9-1.1L17 7.8Z"/>',
    ],
    [
        'label' => 'Total Partner',
        'value' => $counters['partners'] ?? 0,
        'tone'  => 'lime',
        'icon'  => '<path d="M16 11a3 3 0 1 0-2.95-3.55l-3.18 1.8a3 3 0 0 0 0 3.5l3.18 1.8A3 3 0 1 0 16 13a2.97 2.97 0 0 0-1.95.73l-3.13-1.78a3.03 3.03 0 0 0 0-.9l3.13-1.78c.55.46 1.25.73 1.95.73Z"/>',
    ],
];
?>

<div class="space-y-6">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <?php foreach ($cards as $idx => $card): ?>
            <article class="dash-card dash-card-<?= esc($card['tone']) ?>" style="animation-delay: <?= (int) $idx * 70 ?>ms;">
                <div class="dash-card__bg"></div>
                <div class="dash-card__content">
                    <div class="dash-card__icon">
                        <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><?= $card['icon'] ?></svg>
                    </div>
                    <p class="dash-card__label"><?= esc($card['label']) ?></p>
                    <p class="dash-card__value"><?= esc((string) $card['value']) ?></p>
                    <div class="dash-card__meta">
                        <span>Realtime</span>
                        <span class="dash-card__dot"></span>
                        <span>Updated</span>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
        <section class="xl:col-span-2 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg sm:p-6">
            <h2 class="text-base font-semibold text-slate-900">Selamat datang di PGA Admin CMS</h2>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">
                Dashboard telah diperbarui dengan antarmuka modern dan komponen interaktif untuk workflow enterprise.
                Pantau performa visitor dan konten secara real-time melalui analytics.
            </p>
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="<?= site_url('admin/analytics') ?>" class="admin-btn-primary">Buka Visitor Analytics</a>
            </div>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg sm:p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-slate-400">Quick Summary</p>
            <div class="mt-3 space-y-3">
                <div class="rounded-xl bg-slate-50 p-3">
                    <p class="text-xs text-slate-500">Konten Aktif</p>
                    <p class="mt-1 text-lg font-semibold text-slate-800"><?= esc((string) (($counters['products'] ?? 0) + ($counters['articles'] ?? 0) + ($counters['insights'] ?? 0))) ?></p>
                </div>
                <div class="rounded-xl bg-slate-50 p-3">
                    <p class="text-xs text-slate-500">Interaksi Pengunjung</p>
                    <p class="mt-1 text-lg font-semibold text-slate-800"><?= esc((string) ($counters['visitors'] ?? 0)) ?></p>
                </div>
                <div class="rounded-xl bg-slate-50 p-3">
                    <p class="text-xs text-slate-500">Total Jalur Distribusi</p>
                    <p class="mt-1 text-lg font-semibold text-slate-800"><?= esc((string) ($counters['branches'] ?? 0)) ?></p>
                </div>
                <div class="rounded-xl bg-slate-50 p-3">
                    <p class="text-xs text-slate-500">Total Partner</p>
                    <p class="mt-1 text-lg font-semibold text-slate-800"><?= esc((string) ($counters['partners'] ?? 0)) ?></p>
                </div>
            </div>
        </section>
    </div>
</div>
<?= $this->endSection() ?>