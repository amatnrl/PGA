<?= $this->extend('site/layouts/main') ?>

<?= $this->section('content') ?>
<?= view('site/partials/page-header', ['pageTitle' => 'Hubungi Kami', 'pageSubtitle' => 'Kami siap membantu kebutuhan bahan baku bisnis Anda.']) ?>

<div class="max-w-7xl mx-auto px-6 pt-10">
    <?= view('components/breadcrumb', ['breadcrumbs' => [['label' => 'Home', 'url' => site_url('/')], ['label' => 'Contact']]]) ?>
</div>

<section class="px-6 max-w-7xl mx-auto pb-20 pt-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div data-aos="fade-up">
            <div class="rounded-2xl border border-gray-100 bg-white p-7">
                <h3 class="font-heading font-bold text-lg mb-5">Informasi Kontak</h3>
                <div class="space-y-3.5">
                    <?php if (! empty($site['address'])): ?>
                        <div class="flex items-start gap-3">
                            <span class="about-info-icon"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7Zm0 9.6A2.6 2.6 0 1 1 12 6.4a2.6 2.6 0 0 1 0 5.2Z"/></svg></span>
                            <span class="text-sm text-gray-600 leading-relaxed pt-1"><?= esc($site['address']) ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (! empty($site['email'])): ?>
                        <div class="flex items-center gap-3">
                            <span class="about-info-icon"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M3 5h18v14H3V5Zm2.2 2.2v.4l6.8 4.8 6.8-4.8v-.4H5.2Zm13.6 9.6V10l-6.1 4.3a1.2 1.2 0 0 1-1.4 0L5.2 10v6.8h13.6Z"/></svg></span>
                            <span class="text-sm text-gray-600"><?= esc($site['email']) ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (! empty($site['phone'])): ?>
                        <div class="flex items-center gap-3">
                            <span class="about-info-icon"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M17.5 14.4c-.7-.3-1.6-.8-2.3-.4-.4.2-.7.9-1 1.3-.2.3-.5.3-.9.2-2-.8-3.6-2.4-4.4-4.4-.1-.4-.1-.7.2-.9.4-.3 1.1-.6 1.3-1 .4-.7-.1-1.6-.4-2.3-.3-.7-.6-1.5-1.3-1.7-.7-.2-1.6.1-2.1.6-1 1-1.2 2.6-.8 4 .8 3.2 3.5 6.6 6.7 7.9 1.4.6 3.1.7 4.3-.3.6-.5 1.1-1.3.9-2.1-.2-.6-1-1-1.2-.9Z"/></svg></span>
                            <span class="text-sm text-gray-600"><?= esc($site['phone']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (! empty($site['whatsapp'])): ?>
                    <a href="https://wa.me/<?= esc($site['whatsapp']) ?>" target="_blank" rel="noopener" class="marketplace-btn group mt-5">
                        <span class="marketplace-btn-icon"><svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M17.5 14.4c-.7-.3-1.6-.8-2.3-.4-.4.2-.7.9-1 1.3-.2.3-.5.3-.9.2-2-.8-3.6-2.4-4.4-4.4-.1-.4-.1-.7.2-.9.4-.3 1.1-.6 1.3-1 .4-.7-.1-1.6-.4-2.3-.3-.7-.6-1.5-1.3-1.7-.7-.2-1.6.1-2.1.6-1 1-1.2 2.6-.8 4 .8 3.2 3.5 6.6 6.7 7.9 1.4.6 3.1.7 4.3-.3.6-.5 1.1-1.3.9-2.1-.2-.6-1-1-1.2-.9Z"/></svg></span>
                        <span>Chat WhatsApp</span>
                        <svg viewBox="0 0 24 24" class="marketplace-btn-arrow h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                    </a>
                <?php endif; ?>
            </div>

            <?php
            $socialIcons = [
                'instagramUrl' => ['label' => 'Instagram', 'svg' => '<rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r=".15" stroke-width="1.6"/>', 'outline' => true],
                'facebookUrl'  => ['label' => 'Facebook', 'svg' => '<rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><path d="M14 8.6h-1.2c-.8 0-1.3.5-1.3 1.3V11h2.3l-.3 2h-2v6" fill="none"/>', 'outline' => true],
                'tiktokUrl'    => ['label' => 'TikTok', 'svg' => '<path d="M16.7 3h-2.9v12.4a2.5 2.5 0 1 1-1.8-2.4v-3a5.5 5.5 0 1 0 4.7 5.4V9.1a6.9 6.9 0 0 0 4 1.3V7.5a4 4 0 0 1-4-4.5Z"/>', 'outline' => false],
            ];
            $hasSocial = ! empty(array_filter($socialIcons, fn ($k) => ! empty($site[$k]), ARRAY_FILTER_USE_KEY));

            $marketIcons = [
                'shopeeUrl'    => ['label' => 'Shopee', 'svg' => '<path d="M7 8V6.5a5 5 0 0 1 10 0V8h2.2L20 20H4l.8-12H7Zm2-1.5V8h6V6.5a3 3 0 0 0-6 0ZM9 10v1.5a1 1 0 1 0 2 0V10H9Zm4 0v1.5a1 1 0 1 0 2 0V10h-2Z"/>'],
                'tokopediaUrl' => ['label' => 'Tokopedia', 'svg' => '<path d="M4 4h16l1.2 5H2.8L4 4Zm-.6 6h17.2l-.8 10H4.2l-.8-10Zm5.1 2v4h2v-4h-2Zm6 0v4h2v-4h-2Z"/>'],
            ];
            $hasMarket = ! empty(array_filter($marketIcons, fn ($k) => ! empty($site[$k]), ARRAY_FILTER_USE_KEY));
            ?>

            <?php if ($hasSocial): ?>
                <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-7" data-aos="fade-up">
                    <h3 class="font-heading font-bold text-base mb-4">Media Sosial</h3>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach ($socialIcons as $key => $s): ?>
                            <?php if (! empty($site[$key])): ?>
                                <a href="<?= esc($site[$key]) ?>" target="_blank" rel="noopener" class="marketplace-btn group">
                                    <span class="marketplace-btn-icon">
                                        <svg viewBox="0 0 24 24" class="<?= $s['outline'] ? 'h-3.5 w-3.5 fill-none stroke-current' : 'h-3.5 w-3.5 fill-current' ?>" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><?= $s['svg'] ?></svg>
                                    </span>
                                    <span><?= esc($s['label']) ?></span>
                                    <svg viewBox="0 0 24 24" class="marketplace-btn-arrow h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($hasMarket): ?>
                <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-7" data-aos="fade-up" data-aos-delay="80">
                    <h3 class="font-heading font-bold text-base mb-4">Marketplace Kami</h3>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach ($marketIcons as $key => $s): ?>
                            <?php if (! empty($site[$key])): ?>
                                <a href="<?= esc($site[$key]) ?>" target="_blank" rel="noopener" class="marketplace-btn group">
                                    <span class="marketplace-btn-icon"><svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><?= $s['svg'] ?></svg></span>
                                    <span>Beli di <?= esc($s['label']) ?></span>
                                    <svg viewBox="0 0 24 24" class="marketplace-btn-arrow h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div data-aos="fade-up" data-aos-delay="100">
            <div class="w-full overflow-hidden rounded-2xl border border-gray-100 h-72 sm:h-96 lg:h-full">
                <iframe src="https://www.google.com/maps?q=<?= rawurlencode($site['address'] ?? 'Indonesia') ?>&output=embed" class="block h-full w-full" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <?php if (! empty($faqs)): ?>
        <div class="mt-16" data-aos="fade-up">
            <h2 class="font-heading font-bold text-2xl text-center mb-8">FAQ</h2>
            <div class="max-w-3xl mx-auto space-y-3">
                <?php foreach ($faqs as $faq): ?>
                    <details class="group rounded-xl border border-gray-100 bg-white p-4 transition-colors open:border-primary/30">
                        <summary class="flex items-center justify-between font-medium text-sm cursor-pointer list-none">
                            <span><?= esc($faq['question']) ?></span>
                            <svg viewBox="0 0 24 24" class="h-4 w-4 shrink-0 fill-current text-primary transition-transform duration-300 group-open:rotate-45"><path d="M11 4h2v16h-2V4Zm-7 7h16v2H4v-2Z"/></svg>
                        </summary>
                        <p class="text-sm text-gray-500 mt-2"><?= esc($faq['answer']) ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
