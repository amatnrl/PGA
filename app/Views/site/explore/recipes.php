<?= $this->extend('site/layouts/main') ?>

<?= $this->section('content') ?>
<?= view('site/partials/page-header', ['pageTitle' => 'Recipe', 'pageSubtitle' => 'Resep pilihan menggunakan bahan baku berkualitas dari PGA.']) ?>

<div class="max-w-7xl mx-auto px-6 pt-10">
    <?= view('components/breadcrumb', ['breadcrumbs' => [['label' => 'Home', 'url' => site_url('/')], ['label' => 'Explore', 'url' => site_url('explore')], ['label' => 'Recipe']]]) ?>
</div>

<section class="px-6 max-w-7xl mx-auto pb-20 pt-6">
    <div class="flex flex-col lg:flex-row gap-8">
        <?= view('site/explore/partials/sidebar', [
            'types'       => $types,
            'typeKey'     => $typeKey,
            'archives'    => $archives,
            'activeMonth' => $activeMonth,
            'activeYear'  => $activeYear,
            'q'           => $q,
        ]) ?>

        <div class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <?php foreach ($items as $i => $item): ?>
                    <div data-aos="fade-up" data-aos-delay="<?= ($i % 4) * 60 ?>">
                        <?= view('components/explore-card', ['item' => $item, 'baseUrl' => $baseUrl]) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (empty($items)): ?><p class="text-center text-gray-400 py-16">Belum ada resep.</p><?php endif; ?>
            <div class="mt-8"><?= $pager->links() ?></div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
