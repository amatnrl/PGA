<?php
if (empty($testimonials)) {
    return;
}
$heading    = hv($home, 'testimonialHeading', 'Apa Kata Mereka');
$subheading = hv($home, 'testimonialSubheading', 'Pendapat mereka, inspirasi kami untuk terus memberikan yang terbaik.');

// Spread testimonials across vertical columns; repeat the pool so every
// column has enough cards to loop seamlessly regardless of admin data count.
$pool = $testimonials;
while (count($pool) < 6) {
    $pool = array_merge($pool, $testimonials);
}

$columnCount = 4;
$columns     = array_fill(0, $columnCount, []);
foreach ($pool as $i => $t) {
    $columns[$i % $columnCount][] = $t;
}
// Each column needs an even item count so the duplicated half-loop is seamless.
foreach ($columns as $ci => $col) {
    if (count($col) % 2 !== 0) {
        $columns[$ci][] = $col[0];
    }
}
$durations = [26, 32, 24, 30];
?>
<section class="relative overflow-hidden bg-white py-20 px-6">
    <div class="section-motif bg-motif-dots-dark opacity-30"></div>
    <div class="relative mx-auto max-w-site">
        <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
            <h2 class="font-heading font-bold text-3xl md:text-4xl mb-3"><?= esc($heading) ?></h2>
            <p class="text-gray-500"><?= esc($subheading) ?></p>
        </div>

        <div class="tmarquee-stage relative mx-auto h-[480px] max-w-full overflow-hidden rounded-3xl border border-gray-100 bg-[#FBF7F2]" data-aos="zoom-in">
            <div class="tmarquee-tilt flex h-full items-center justify-center gap-4 px-4">
                <?php foreach ($columns as $ci => $col): ?>
                    <div class="tmarquee-col-mask h-[120%] w-64 shrink-0 overflow-hidden <?= $ci >= 2 ? 'hidden md:block' : '' ?>">
                        <div class="tmarquee-col flex flex-col gap-4 <?= $ci % 2 === 1 ? 'tmarquee-reverse' : '' ?>" style="--tmarquee-duration: <?= (int) $durations[$ci % count($durations)] ?>s">
                            <?php foreach (array_merge($col, $col) as $t): ?>
                                <div class="tmarquee-card rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                                    <div class="text-amber-400 mb-2 text-xs"><?= str_repeat('★', (int) $t['rating']) ?><span class="text-gray-200"><?= str_repeat('★', 5 - (int) $t['rating']) ?></span></div>
                                    <p class="text-xs text-gray-600 leading-relaxed line-clamp-3">&ldquo;<?= esc($t['content']) ?>&rdquo;</p>
                                    <div class="mt-3 flex items-center gap-2.5">
                                        <?php if (! empty($t['photo'])): ?>
                                            <img src="<?= base_url($t['photo']) ?>" alt="<?= esc($t['name']) ?>" loading="lazy" class="h-8 w-8 rounded-full object-cover">
                                        <?php else: ?>
                                            <div class="h-8 w-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-semibold text-xs"><?= esc(strtoupper(substr($t['name'], 0, 1))) ?></div>
                                        <?php endif; ?>
                                        <div class="min-w-0">
                                            <div class="truncate text-xs font-semibold text-accent-black"><?= esc($t['name']) ?></div>
                                            <div class="truncate text-[11px] text-gray-400"><?= esc($t['position'] ?? '') ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="pointer-events-none absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-[#FBF7F2] to-transparent"></div>
            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-[#FBF7F2] to-transparent"></div>
            <div class="pointer-events-none absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-[#FBF7F2] to-transparent"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-[#FBF7F2] to-transparent"></div>
        </div>
    </div>
</section>
