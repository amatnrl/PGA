<?php
$tagline = $site['tagline'] ?? '';
$desc1   = hv($home, 'profileDesc1', '<h3 class="font-heading font-bold text-3xl mb-4">Berpengalaman dalam Industri Pangan</h3><p>PT. Pancaran Gemilang Abadi telah dipercaya menjadi mitra distribusi bahan baku makanan dan minuman berkualitas di seluruh Sulawesi.</p>');
$desc2   = hv($home, 'profileDesc2', '<h3 class="font-heading font-bold text-3xl mb-4">Mitra Bisnis Terbaik Anda</h3><p>Kami berkomitmen menghadirkan produk terbaik dengan layanan profesional dan harga yang kompetitif bagi seluruh mitra usaha kami.</p>');
$image   = $home['profileImage'] ?? '';
?>
<section class="relative overflow-hidden bg-white pt-0 pb-20 px-6">
    <div class="section-motif bg-motif-dots-dark opacity-40"></div>
    <div class="relative mx-auto grid max-w-site grid-cols-1 items-end gap-8 lg:grid-cols-[1fr_1.3fr_1fr]">
        <div class="order-2 min-w-0 lg:order-1" data-aos="fade-right">
            <div class="text-xs md:text-sm leading-relaxed text-gray-600 [&_h3]:font-heading [&_h3]:font-bold [&_h3]:text-lg [&_h3]:md:text-xl [&_h3]:mb-2.5 [&_h3]:text-accent-black [&_p]:mb-2.5"><?= $desc1 ?></div>

            <?php if ($tagline !== ''): ?>
                <div class="mt-5 flex items-start gap-3 rounded-2xl border border-primary/15 bg-primary/5 px-4 py-3.5">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary text-white">
                        <svg viewBox="0 0 24 24" class="h-[18px] w-[18px] fill-current">
                            <path d="m12 2 2.6 5.6 6.2.8-4.5 4.3 1.1 6.1L12 15.9l-5.4 2.9 1.1-6.1-4.5-4.3 6.2-.8L12 2Z" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-primary">Tagline Kami</p>
                        <p class="truncate text-xs font-semibold text-accent-black leading-snug"><?= esc($tagline) ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="order-1 lg:order-2" data-aos="zoom-in" data-aos-delay="100">
            <img src="<?= $image ? base_url($image) : 'https://placehold.co/600x500?text=PGA' ?>" alt="PGA" loading="lazy" class="h-72 w-full rounded-2xl object-contain object-bottom lg:h-[460px]">
        </div>

        <div class="order-3 min-w-0 lg:order-3" data-aos="fade-left" data-aos-delay="150">
            <div class="text-xs md:text-sm leading-relaxed text-gray-600 [&_h3]:font-heading [&_h3]:font-bold [&_h3]:text-lg [&_h3]:md:text-xl [&_h3]:mb-2.5 [&_h3]:text-accent-black [&_p]:mb-2.5"><?= $desc2 ?></div>
            <a href="<?= site_url('about') ?>" class="btn-icon mt-5 inline-flex items-center gap-2 rounded-full bg-primary text-white font-semibold px-6 py-3.5 hover:bg-primary-dark transition-colors">
                <span>Selengkapnya Tentang Kami</span>
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current btn-icon-arrow">
                    <path d="M5 12h12m-5-6 6 6-6 6" />
                </svg>
            </a>
        </div>
    </div>
</section>