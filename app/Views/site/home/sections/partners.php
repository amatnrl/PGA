<?php
if (empty($partners)) {
    return;
}
$heading = hv($home, 'partnerHeading', 'Mereka Yang Telah Mempercayai Kami');
?>
<section class="relative py-16 px-6 bg-[#FBF7F2] overflow-hidden">
    <h2 class="font-heading font-bold text-2xl md:text-3xl text-center mb-12" data-aos="fade-up"><?= esc($heading) ?></h2>
    <div class="relative [mask-image:linear-gradient(90deg,transparent,black_8%,black_92%,transparent)]">
        <div class="partner-slider flex gap-6 items-stretch">
            <?php foreach (array_merge($partners, $partners) as $p): ?>
                <a href="<?= esc($p['website_url'] ?: '#') ?>" class="partner-card shrink-0 flex h-28 w-44 items-center justify-center rounded-2xl border border-gray-100 bg-white p-5">
                    <img src="<?= base_url($p['logo']) ?>" alt="<?= esc($p['name']) ?>" loading="lazy" class="max-h-14 max-w-full object-contain transition duration-300">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
