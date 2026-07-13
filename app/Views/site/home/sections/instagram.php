<?php
$igImages = [];
$igUrls   = [];
$defaultIgUrl = $site['instagramUrl'] ?? '#';
for ($i = 1; $i <= 6; $i++) {
    $igImages[] = $home["igImage{$i}"] ?? '';
    $igUrls[]   = ! empty($home["igUrl{$i}"]) ? $home["igUrl{$i}"] : $defaultIgUrl;
}
if (count(array_filter($igImages)) === 0) {
    return;
}
$heading   = hv($home, 'igHeading', 'Ikuti Kami di Instagram!');
$handle    = hv($home, 'igHandle', '@pga.id');
$caption   = hv($home, 'igCaption', 'Kreasikan momen baking favoritmu dan jadikan inspirasimu bersinar bersama PGA.');
$igUrl     = $defaultIgUrl;
?>
<section class="relative overflow-hidden bg-primary py-20 px-6">
    <div class="section-motif bg-motif-dots opacity-20"></div>
    <div class="pointer-events-none absolute -right-16 -top-16 h-72 w-72 rounded-full border-[10px] border-white/10"></div>
    <div class="pointer-events-none absolute -left-10 bottom-0 h-44 w-44 rounded-full border-[8px] border-white/10"></div>
    <div class="relative mx-auto max-w-site">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="<?= esc($igUrls[0]) ?>" target="_blank" rel="noopener" class="ig-card group relative order-2 col-span-1 overflow-hidden rounded-2xl bg-white/10 sm:order-1" data-aos="fade-up">
                <?php if (! empty($igImages[0])): ?>
                    <img src="<?= base_url($igImages[0]) ?>" alt="Instagram PGA" loading="lazy" class="aspect-[3/4] h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                <?php endif; ?>
                <span class="absolute inset-0 flex items-center justify-center bg-black/0 opacity-0 group-hover:bg-black/30 group-hover:opacity-100 transition-all duration-300">
                    <svg viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r=".15" fill="#fff" stroke="#fff" stroke-width="1.6"/></svg>
                </span>
            </a>

            <div class="order-1 col-span-2 flex flex-col items-center justify-center gap-4 text-center text-white sm:order-2" data-aos="zoom-in">
                <h2 class="font-heading font-bold text-2xl sm:text-3xl leading-tight"><?= esc($heading) ?></h2>
                <a href="<?= esc($igUrl) ?>" target="_blank" rel="noopener" class="btn-icon-circle flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 ring-1 ring-white/30 hover:bg-white/25 transition-colors">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-primary">
                        <svg viewBox="0 0 24 24" class="h-[18px] w-[18px]" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r=".15" fill="currentColor" stroke="currentColor" stroke-width="1.6"/></svg>
                    </span>
                    <span class="font-heading font-bold text-lg"><?= esc($handle) ?></span>
                </a>
                <?php if ($caption !== ''): ?>
                    <p class="max-w-sm text-sm text-white/75 leading-relaxed"><?= esc($caption) ?></p>
                <?php endif; ?>
            </div>

            <a href="<?= esc($igUrls[1]) ?>" target="_blank" rel="noopener" class="ig-card group relative order-3 col-span-1 overflow-hidden rounded-2xl bg-white/10" data-aos="fade-up" data-aos-delay="80">
                <?php if (! empty($igImages[1])): ?>
                    <img src="<?= base_url($igImages[1]) ?>" alt="Instagram PGA" loading="lazy" class="aspect-[3/4] h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                <?php endif; ?>
                <span class="absolute inset-0 flex items-center justify-center bg-black/0 opacity-0 group-hover:bg-black/30 group-hover:opacity-100 transition-all duration-300">
                    <svg viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r=".15" fill="#fff" stroke="#fff" stroke-width="1.6"/></svg>
                </span>
            </a>

            <?php
            $bottomOrderClasses = ['order-4', 'order-5', 'order-6', 'order-7'];
            for ($i = 2; $i <= 5; $i++):
            ?>
                <a href="<?= esc($igUrls[$i]) ?>" target="_blank" rel="noopener" class="ig-card group relative <?= $bottomOrderClasses[$i - 2] ?> col-span-1 overflow-hidden rounded-2xl bg-white/10" data-aos="fade-up" data-aos-delay="<?= ($i - 1) * 60 ?>">
                    <?php if (! empty($igImages[$i])): ?>
                        <img src="<?= base_url($igImages[$i]) ?>" alt="Instagram PGA" loading="lazy" class="aspect-square h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <?php endif; ?>
                    <span class="absolute inset-0 flex items-center justify-center bg-black/0 opacity-0 group-hover:bg-black/30 group-hover:opacity-100 transition-all duration-300">
                        <svg viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r=".15" fill="#fff" stroke="#fff" stroke-width="1.6"/></svg>
                    </span>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</section>
