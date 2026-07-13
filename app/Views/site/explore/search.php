<?= $this->extend('site/layouts/main') ?>

<?= $this->section('content') ?>
<?= view('site/partials/page-header', ['pageTitle' => 'Hasil Pencarian']) ?>

<div class="max-w-7xl mx-auto px-6 pt-10">
    <?= view('components/breadcrumb', ['breadcrumbs' => [['label' => 'Home', 'url' => site_url('/')], ['label' => 'Explore', 'url' => site_url('explore')], ['label' => 'Hasil Pencarian']]]) ?>
</div>

<?php
$groups = [
    ['title' => 'Baking Insight', 'items' => $results['insight'], 'baseUrl' => 'explore/insight'],
    ['title' => 'Recipe', 'items' => $results['recipe'], 'baseUrl' => 'explore/recipe'],
    ['title' => 'Article', 'items' => $results['article'], 'baseUrl' => 'explore/article'],
    ['title' => 'Activity', 'items' => $results['activity'], 'baseUrl' => 'explore/activity'],
];
$hasAny = array_sum(array_map(fn ($g) => count($g['items']), $groups)) > 0;
?>
<?php if (! $hasAny): ?>
    <p class="text-center text-gray-400 py-16">Tidak ada hasil ditemukan.</p>
<?php endif; ?>
<?php foreach ($groups as $g): ?>
    <?php if (! empty($g['items'])): ?>
        <section class="py-8 px-6 max-w-7xl mx-auto">
            <h2 class="font-heading font-bold text-xl mb-6"><?= esc($g['title']) ?></h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                <?php foreach ($g['items'] as $item): ?>
                    <?= view('components/content-card', ['item' => $item, 'baseUrl' => $g['baseUrl']]) ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>
<?= $this->endSection() ?>
