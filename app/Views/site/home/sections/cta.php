<?php
$heading    = hv($home, 'ctaHeading', 'Siap Bekerja Sama dengan PGA?');
$text       = hv($home, 'ctaText', 'Hubungi tim kami untuk konsultasi kebutuhan bahan baku bisnis Anda.');
$buttonText = hv($home, 'ctaButtonText', 'Hubungi Kami Sekarang');
$buttonUrl  = hv($home, 'ctaButtonUrl', 'contact');
$linkify    = fn (string $u) => (str_starts_with($u, 'http') ? $u : site_url($u));
?>
<section class="px-6 py-4">
    <div class="max-w-7xl mx-auto rounded-3xl bg-gradient-to-r from-primary to-primary-dark text-white text-center px-6 py-16 relative overflow-hidden" data-aos="zoom-in">
        <div class="absolute -left-16 -bottom-16 w-64 h-64 rounded-full bg-white/10 blur-2xl"></div>
        <div class="relative">
            <h2 class="font-heading font-bold text-3xl md:text-4xl mb-4"><?= esc($heading) ?></h2>
            <p class="text-white/85 max-w-xl mx-auto mb-8"><?= esc($text) ?></p>
            <a href="<?= $linkify($buttonUrl) ?>" class="inline-flex rounded-full bg-white text-primary font-semibold px-8 py-3.5 hover:bg-gray-100 transition-colors shadow-lg"><?= esc($buttonText) ?></a>
        </div>
    </div>
</section>
