<?php
$footerSite = $site ?? (new \App\Services\SettingService())->getSite();

$companyName = $footerSite['companyName'] ?? 'PT. Pancaran Gemilang Abadi';
$tagline     = $footerSite['tagline'] ?? 'Solusi Bahan Baku Berkualitas untuk Bisnis yang Terus Bertumbuh';
$footerEmail = $footerSite['email'] ?? 'kontak.pga@gmail.com';
$footerPhone = $footerSite['phone'] ?? '0822 9361 6520';
$footerAddr  = $footerSite['address'] ?? 'Jl. Kyai H. Agus Salim No.36, Ende, Kec. Wajo, Kota Makassar, Sulawesi Selatan 90174';
$igUrl       = $footerSite['instagramUrl'] ?? '';
$fbUrl       = $footerSite['facebookUrl'] ?? '';
$ttUrl       = $footerSite['tiktokUrl'] ?? '';
$shopeeUrl   = $footerSite['shopeeUrl'] ?? '';
$tokopediaUrl = $footerSite['tokopediaUrl'] ?? '';
?>
<div class="relative mt-24 h-20 overflow-hidden bg-primary">
    <div class="absolute inset-y-0 left-0 h-full w-[200%] scale-y-[-1]">
        <svg class="footer-wave footer-wave-back absolute inset-y-0 left-0 h-full" viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" fill-opacity=".5" d="M0,55 C90,15 180,85 270,55 C360,25 450,85 540,55 C630,25 720,85 810,55 C900,25 990,85 1080,55 C1170,25 1260,85 1350,55 C1395,40 1417,70 1440,55 L1440,100 L0,100 Z M1440,55 C1530,15 1620,85 1710,55 C1800,25 1890,85 1980,55 C2070,25 2160,85 2250,55 C2340,25 2430,85 2520,55 C2610,25 2700,85 2790,55 C2835,40 2857,70 2880,55 L2880,100 L1440,100 Z"></path>
        </svg>
    </div>
    <div class="absolute inset-y-0 left-0 h-full w-[200%] scale-y-[-1]">
        <svg class="footer-wave footer-wave-front absolute inset-y-0 left-0 h-full" viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" d="M0,60 C60,90 120,30 180,55 C240,80 300,20 360,50 C420,80 480,25 540,55 C600,85 660,25 720,50 C780,75 840,20 900,50 C960,80 1020,25 1080,55 C1140,85 1200,25 1260,50 C1320,75 1380,30 1440,60 L1440,100 L0,100 Z M1440,60 C1500,90 1560,30 1620,55 C1680,80 1740,20 1800,50 C1860,80 1920,25 1980,55 C2040,85 2100,25 2160,50 C2220,75 2280,20 2340,50 C2400,80 2460,25 2520,55 C2580,85 2640,25 2700,50 C2760,75 2820,30 2880,60 L2880,100 L1440,100 Z"></path>
        </svg>
    </div>
</div>
<footer class="relative overflow-hidden bg-primary text-white/85 -mt-px">
    <div class="section-motif bg-motif-dots opacity-10"></div>

    <div class="relative mx-auto max-w-site px-6 py-16 grid grid-cols-1 gap-12 md:grid-cols-3 md:items-start">
        <div class="order-2 md:order-none">
            <p class="text-sm leading-relaxed text-white/75"><?= esc($companyName) ?>, <?= esc($tagline) ?></p>

            <h4 class="mt-6 font-heading font-bold text-white text-base">Hubungi Kami</h4>
            <ul class="mt-3 space-y-3 text-sm text-white/75">
                <li class="flex items-start gap-3">
                    <span class="footer-contact-icon"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7Zm0 9.6A2.6 2.6 0 1 1 12 6.4a2.6 2.6 0 0 1 0 5.2Z"/></svg></span>
                    <span><?= esc($footerAddr) ?></span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="footer-contact-icon"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M17.5 14.4c-.7-.3-1.6-.8-2.3-.4-.4.2-.7.9-1 1.3-.2.3-.5.3-.9.2-2-.8-3.6-2.4-4.4-4.4-.1-.4-.1-.7.2-.9.4-.3 1.1-.6 1.3-1 .4-.7-.1-1.6-.4-2.3-.3-.7-.6-1.5-1.3-1.7-.7-.2-1.6.1-2.1.6-1 1-1.2 2.6-.8 4 .8 3.2 3.5 6.6 6.7 7.9 1.4.6 3.1.7 4.3-.3.6-.5 1.1-1.3.9-2.1-.2-.6-1-1-1.2-.9Z"/></svg></span>
                    <span><?= esc($footerPhone) ?></span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="footer-contact-icon"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M3 5h18v14H3V5Zm2.2 2.2v.4l6.8 4.8 6.8-4.8v-.4H5.2Zm13.6 9.6V10l-6.1 4.3a1.2 1.2 0 0 1-1.4 0L5.2 10v6.8h13.6Z"/></svg></span>
                    <span><?= esc($footerEmail) ?></span>
                </li>
            </ul>
        </div>

        <div class="order-1 flex flex-col items-center text-center md:order-none md:pt-2">
            <div class="flex h-24 w-24 items-center justify-center rounded-3xl bg-white/15 ring-1 ring-white/25">
                <?php if (! empty($footerSite['logo'])): ?>
                    <img src="<?= base_url($footerSite['logo']) ?>" alt="<?= esc($companyName) ?>" class="h-16 w-16 object-contain">
                <?php else: ?>
                    <span class="font-heading font-extrabold text-3xl text-white">PGA</span>
                <?php endif; ?>
            </div>
            <h3 class="mt-5 font-heading font-bold text-xl sm:text-2xl text-white"><?= esc($companyName) ?></h3>

            <div class="mt-6 flex items-center gap-3">
                <?php if ($igUrl !== ''): ?>
                    <a href="<?= esc($igUrl) ?>" target="_blank" rel="noopener" aria-label="Instagram" class="footer-social-btn group">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r=".15" fill="currentColor" stroke="currentColor" stroke-width="1.6"/></svg>
                        <span class="footer-tooltip">Instagram</span>
                    </a>
                <?php endif; ?>
                <?php if ($fbUrl !== ''): ?>
                    <a href="<?= esc($fbUrl) ?>" target="_blank" rel="noopener" aria-label="Facebook" class="footer-social-btn group">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><path d="M14 8.6h-1.2c-.8 0-1.3.5-1.3 1.3V11h2.3l-.3 2h-2v6" fill="none"/></svg>
                        <span class="footer-tooltip">Facebook</span>
                    </a>
                <?php endif; ?>
                <?php if ($ttUrl !== ''): ?>
                    <a href="<?= esc($ttUrl) ?>" target="_blank" rel="noopener" aria-label="TikTok" class="footer-social-btn group">
                        <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M16.7 3h-2.9v12.4a2.5 2.5 0 1 1-1.8-2.4v-3a5.5 5.5 0 1 0 4.7 5.4V9.1a6.9 6.9 0 0 0 4 1.3V7.5a4 4 0 0 1-4-4.5Z"/></svg>
                        <span class="footer-tooltip">TikTok</span>
                    </a>
                <?php endif; ?>
                <?php if ($shopeeUrl !== ''): ?>
                    <a href="<?= esc($shopeeUrl) ?>" target="_blank" rel="noopener" aria-label="Shopee" class="footer-social-btn group">
                        <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M7 8V6.5a5 5 0 0 1 10 0V8h2.2L20 20H4l.8-12H7Zm2-1.5V8h6V6.5a3 3 0 0 0-6 0ZM9 10v1.5a1 1 0 1 0 2 0V10H9Zm4 0v1.5a1 1 0 1 0 2 0V10h-2Z"/></svg>
                        <span class="footer-tooltip">Shopee</span>
                    </a>
                <?php endif; ?>
                <?php if ($tokopediaUrl !== ''): ?>
                    <a href="<?= esc($tokopediaUrl) ?>" target="_blank" rel="noopener" aria-label="Tokopedia" class="footer-social-btn group">
                        <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M4 4h16l1.2 5H2.8L4 4Zm-.6 6h17.2l-.8 10H4.2l-.8-10Zm5.1 2v4h2v-4h-2Zm6 0v4h2v-4h-2Z"/></svg>
                        <span class="footer-tooltip">Tokopedia</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="order-3 md:order-none md:text-right">
            <h4 class="font-heading font-bold text-white text-base">Tautan Cepat</h4>
            <ul class="mt-3 space-y-2.5 text-sm">
                <li><a href="<?= site_url('about') ?>" class="hover:text-white transition-colors">Tentang Kami</a></li>
                <li><a href="<?= site_url('product') ?>" class="hover:text-white transition-colors">Produk Unggulan</a></li>
                <li><a href="<?= site_url('explore') ?>" class="hover:text-white transition-colors">Layanan Kami</a></li>
                <li><a href="<?= site_url('explore/insight') ?>" class="hover:text-white transition-colors">Baking Insight</a></li>
                <li><a href="<?= site_url('contact') ?>" class="hover:text-white transition-colors">Hubungi Kami</a></li>
            </ul>
        </div>
    </div>

    <div class="relative border-t border-white/15 py-5 text-center text-xs text-white/60">
        &copy; <?= date('Y') ?> <?= esc($companyName) ?>. All rights reserved.
    </div>
</footer>
