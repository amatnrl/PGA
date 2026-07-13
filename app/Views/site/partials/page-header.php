<?php
/**
 * Generic page header banner — same red/dots-motif treatment as the
 * "Berbagai Macam Jenis Produk Kami" home section. Used on every public
 * page except Home, which has its own hero banner.
 *
 * @var string $pageTitle
 * @var string $pageSubtitle
 */
$pageTitle    = $pageTitle ?? '';
$pageSubtitle = $pageSubtitle ?? '';
?>
<section class="relative overflow-hidden bg-primary pt-24 pb-10 px-6 sm:pt-32 sm:pb-14" data-hero-flush>
    <div class="section-motif bg-motif-dots opacity-20"></div>
    <div class="pointer-events-none absolute -right-16 -top-16 h-72 w-72 rounded-full border-[10px] border-white/10"></div>
    <div class="pointer-events-none absolute -left-10 bottom-0 h-44 w-44 rounded-full border-[8px] border-white/10"></div>
    <div class="relative mx-auto max-w-site text-center text-white" data-aos="fade-up">
        <h1 class="font-heading font-bold text-3xl md:text-4xl"><?= esc($pageTitle) ?></h1>
        <?php if ($pageSubtitle !== ''): ?>
            <p class="mt-3 text-white/75 max-w-2xl mx-auto"><?= esc($pageSubtitle) ?></p>
        <?php endif; ?>
    </div>
</section>
