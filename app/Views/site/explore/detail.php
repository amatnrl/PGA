<?= $this->extend('site/layouts/main') ?>

<?= $this->section('content') ?>
<?= view('site/partials/page-header', ['pageTitle' => $item['title'], 'pageSubtitle' => $hubLabel ?? '']) ?>

<div class="max-w-7xl mx-auto px-6 pt-10">
    <?= view('components/breadcrumb', ['breadcrumbs' => [
        ['label' => 'Home', 'url' => site_url('/')],
        ['label' => 'Explore', 'url' => site_url('explore')],
        ['label' => $hubLabel, 'url' => site_url($hubUrl)],
        ['label' => $item['title']],
    ]]) ?>
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

        <div class="flex-1 min-w-0">
            <article>
                <a href="<?= site_url($hubUrl) ?>" class="btn-icon inline-flex items-center gap-1.5 text-xs font-semibold text-primary hover:underline mb-4">
                    <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M15 6 9 12l6 6"/></svg>
                    <span>Kembali ke <?= esc($hubLabel) ?></span>
                </a>

                <h1 class="font-heading font-extrabold text-2xl md:text-4xl mb-3 leading-tight" data-aos="fade-up"><?= esc($item['title']) ?></h1>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-400 mb-6">
                    <span class="inline-flex items-center gap-1.5">
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M12 3.5a4.3 4.3 0 1 1 0 8.6 4.3 4.3 0 0 1 0-8.6Zm0 10.8c4.2 0 7.6 2.4 7.6 5.4V21H4.4v-1.3c0-3 3.4-5.4 7.6-5.4Z"/></svg>
                        <?= esc($item['updated_by'] ?? 'Admin') ?>
                    </span>
                    <?php if (! empty($item['published_at'])): ?>
                        <span class="inline-flex items-center gap-1.5">
                            <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7ZM3 10v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10H3Z"/></svg>
                            <?= esc(date('d M Y', strtotime($item['published_at']))) ?>
                        </span>
                    <?php endif; ?>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 px-2.5 py-1 font-semibold text-primary"><?= esc($hubLabel) ?></span>
                </div>

                <?php if (! empty($embedUrl)): ?>
                    <?php if (! empty($item['featured_image'])): ?>
                        <div class="relative mb-8 overflow-hidden rounded-2xl bg-gray-50" data-aos="zoom-in">
                            <img src="<?= base_url($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy" class="w-full max-h-[420px] object-cover">
                        </div>
                    <?php endif; ?>
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                        <div class="lg:col-span-3" data-aos="fade-right">
                            <div class="prose prose-sm md:prose-base text-gray-600"><?= $item['content'] ?? '' ?></div>
                        </div>
                        <div class="lg:col-span-2 lg:sticky lg:top-24 lg:self-start" data-aos="fade-left">
                            <div class="<?= ! empty($embedIsTall) ? 'aspect-[9/16] max-w-[220px] mx-auto' : 'w-full aspect-[16/8]' ?> overflow-hidden rounded-2xl bg-black shadow-lg">
                                <iframe src="<?= esc($embedUrl) ?>" class="h-full w-full" loading="lazy" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                            </div>
                            <p class="mt-3 text-xs text-gray-400 text-center">Video resep <?= esc($item['title']) ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if (! empty($item['featured_image'])): ?>
                        <div class="relative mb-8 overflow-hidden rounded-2xl bg-gray-50" data-aos="zoom-in">
                            <img src="<?= base_url($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy" class="w-full max-h-[460px] object-cover">
                        </div>
                    <?php endif; ?>

                    <div class="prose prose-sm md:prose-base text-gray-600"><?= $item['content'] ?? '' ?></div>
                <?php endif; ?>
            </article>

            <?php if (! empty($related)): ?>
            <div class="mt-16">
                <div class="flex items-center justify-between mb-6" data-aos="fade-up">
                    <h2 class="font-heading font-bold text-xl">Terkait Lainnya</h2>
                    <?php if (count($related) > 4): ?>
                        <div class="hidden sm:flex items-center gap-2 shrink-0">
                            <button type="button" class="carousel-arrow-btn" data-scroll-target="related-content-carousel" data-scroll-dir="prev" aria-label="Sebelumnya">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M15 6l-6 6 6 6"/></svg>
                            </button>
                            <button type="button" class="carousel-arrow-btn" data-scroll-target="related-content-carousel" data-scroll-dir="next" aria-label="Berikutnya">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M9 6l6 6-6 6"/></svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <div id="related-content-carousel" class="no-scrollbar flex gap-5 overflow-x-auto scroll-smooth snap-x snap-mandatory py-3">
                    <?php foreach ($related as $r): ?>
                        <div class="w-[88%] shrink-0 snap-start sm:w-[60%] lg:w-[48%]">
                            <?= view('components/explore-card', ['item' => $r, 'baseUrl' => $baseUrl]) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
