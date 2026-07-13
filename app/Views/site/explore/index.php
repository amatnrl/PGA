<?= $this->extend('site/layouts/main') ?>

<?= $this->section('content') ?>
<?= view('site/partials/page-header', ['pageTitle' => 'Explore PGA', 'pageSubtitle' => 'Baking Insight, Recipe, Article, dan Activity dari PGA — pusat edukasi pelanggan.']) ?>

<div class="max-w-7xl mx-auto px-6 pt-10">
    <?= view('components/breadcrumb', ['breadcrumbs' => [['label' => 'Home', 'url' => site_url('/')], ['label' => 'Explore']]]) ?>
</div>

<section class="px-6 max-w-3xl mx-auto text-center pb-10" data-aos="fade-up">
    <form method="get" action="<?= site_url('explore') ?>">
        <input type="text" name="q" placeholder="Cari insight, resep, artikel, aktivitas..." class="w-full max-w-lg rounded-full border-gray-300 text-sm px-5 py-3">
    </form>
</section>

<?php
$sections = [
    ['title' => 'Baking Insight', 'items' => $insights, 'baseUrl' => 'explore/insight', 'hub' => 'explore/insight'],
    ['title' => 'Recipe', 'items' => $recipes, 'baseUrl' => 'explore/recipe', 'hub' => 'explore/recipe'],
    ['title' => 'Article', 'items' => $articles, 'baseUrl' => 'explore/article', 'hub' => 'explore/article'],
    ['title' => 'Activity', 'items' => $activities, 'baseUrl' => 'explore/activity', 'hub' => 'explore/activity'],
];
?>
<?php foreach ($sections as $section): ?>
    <?php if (! empty($section['items'])): ?>
        <section class="py-10 px-6 max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h2 class="font-heading font-bold text-2xl" data-aos="fade-up"><?= esc($section['title']) ?></h2>
                <a href="<?= site_url($section['hub']) ?>" class="text-sm font-semibold text-primary hover:underline">Lihat Semua &rarr;</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                <?php foreach ($section['items'] as $item): ?>
                    <?= view('components/content-card', ['item' => $item, 'baseUrl' => $section['baseUrl']]) ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>
<?= $this->endSection() ?>
