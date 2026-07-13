<?php
$label1 = hv($home, 'achvLabel1', 'Produk Tersedia');
$label2 = hv($home, 'achvLabel2', 'Partner Brand');
$label3 = hv($home, 'achvLabel3', 'Pelanggan Puas');
?>
<section class="py-16 px-6 bg-accent-black text-white relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-72 h-72 rounded-full bg-primary/20 blur-3xl"></div>
    <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-10 text-center relative">
        <div data-aos="fade-up">
            <div class="counter font-heading font-extrabold text-5xl text-primary" data-count="<?= (int) $counters['products'] ?>">0</div>
            <div class="text-sm text-gray-300 mt-2"><?= esc($label1) ?></div>
        </div>
        <div data-aos="fade-up" data-aos-delay="100">
            <div class="counter font-heading font-extrabold text-5xl text-primary" data-count="<?= (int) $counters['partners'] ?>">0</div>
            <div class="text-sm text-gray-300 mt-2"><?= esc($label2) ?></div>
        </div>
        <div data-aos="fade-up" data-aos-delay="200">
            <div class="counter font-heading font-extrabold text-5xl text-primary" data-count="<?= (int) $counters['testimonials'] ?>">0</div>
            <div class="text-sm text-gray-300 mt-2"><?= esc($label3) ?></div>
        </div>
    </div>
</section>
