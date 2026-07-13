<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="text-2xl font-heading font-bold"><?= esc((string) $total) ?></div>
        <div class="text-sm text-gray-500">Total Visitor (sepanjang waktu)</div>
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h2 class="font-heading font-semibold text-base mb-4">Visitor 14 Hari Terakhir</h2>
    <?php
    $max = max(array_merge(array_values($dailyCounts), [1]));
    $barWidth = 40;
    $gap = 10;
    $chartHeight = 160;
    $width = count($dailyCounts) * ($barWidth + $gap);
    ?>
    <svg viewBox="0 0 <?= $width ?> <?= $chartHeight + 30 ?>" class="w-full" style="max-height: 220px">
        <?php $x = 0; ?>
        <?php foreach ($dailyCounts as $date => $count): ?>
            <?php $h = $count > 0 ? max(4, (int) (($count / $max) * $chartHeight)) : 2; ?>
            <rect x="<?= $x ?>" y="<?= $chartHeight - $h ?>" width="<?= $barWidth ?>" height="<?= $h ?>" rx="4" fill="#D60000"></rect>
            <text x="<?= $x + $barWidth / 2 ?>" y="<?= $chartHeight + 14 ?>" font-size="9" text-anchor="middle" fill="#888"><?= esc(date('d/m', strtotime($date))) ?></text>
            <text x="<?= $x + $barWidth / 2 ?>" y="<?= $chartHeight - $h - 4 ?>" font-size="9" text-anchor="middle" fill="#333"><?= $count ?></text>
            <?php $x += $barWidth + $gap; ?>
        <?php endforeach; ?>
    </svg>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6">
    <h2 class="font-heading font-semibold text-base mb-4">Top 5 Halaman</h2>
    <ul class="divide-y divide-gray-100 text-sm">
        <?php foreach ($topPages as $p): ?>
            <li class="py-2 flex justify-between">
                <span class="text-gray-600 truncate"><?= esc($p['url']) ?></span>
                <span class="font-semibold"><?= esc((string) $p['total']) ?></span>
            </li>
        <?php endforeach; ?>
        <?php if (empty($topPages)): ?><li class="py-4 text-center text-gray-400">Belum ada data.</li><?php endif; ?>
    </ul>
</div>
<?= $this->endSection() ?>
