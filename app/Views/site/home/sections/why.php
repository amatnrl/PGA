<?php
$heading    = hv($home, 'whyHeading', 'Alasan Kenapa Kami Selalu Jadi Pilihan Utama');
$subheading = hv($home, 'whySubheading', 'Kami menjaga dan memastikan konsistensi produk kami dari segi kualitas, dan cita rasa demi mewujudkan kepuasan konsumen.');

$features = [];
for ($i = 1; $i <= 3; $i++) {
    $name = $home["feature{$i}Name"] ?? '';
    if ($name === '') {
        continue;
    }
    $features[] = [
        'name'  => $name,
        'desc'  => $home["feature{$i}Desc"] ?? '',
        'image' => $home["feature{$i}Image"] ?? '',
    ];
}
if (empty($features)) {
    return;
}
?>
<section class="relative overflow-hidden bg-[#FBF7F2] py-20 px-6">
    <div class="section-motif bg-motif-dots opacity-30"></div>
    <div class="relative mx-auto max-w-site">
        <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
            <h2 class="font-heading font-bold text-3xl md:text-4xl mb-3"><?= esc($heading) ?></h2>
            <p class="text-gray-500"><?= esc($subheading) ?></p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <?php foreach ($features as $i => $f): ?>
                <div class="why-card relative flex items-start gap-4 overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 text-left" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                    <div class="why-card-motif absolute -right-6 -top-6 h-28 w-28 rounded-full bg-primary/5"></div>
                    <div class="relative h-16 w-16 shrink-0 overflow-hidden rounded-xl bg-primary/10 ring-1 ring-primary/10">
                        <?php if (! empty($f['image'])): ?>
                            <img src="<?= base_url($f['image']) ?>" alt="<?= esc($f['name']) ?>" loading="lazy" class="h-full w-full object-cover">
                        <?php else: ?>
                            <span class="flex h-full w-full items-center justify-center text-2xl text-primary">✔</span>
                        <?php endif; ?>
                    </div>
                    <div class="relative z-10">
                        <h3 class="font-heading font-semibold text-base mb-1.5"><?= esc($f['name']) ?></h3>
                        <p class="text-sm text-gray-500 leading-relaxed"><?= esc($f['desc']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
