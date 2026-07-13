<?php
if (empty($homeCategories)) {
    return;
}
$heading    = hv($home, 'categoriesHeading', 'Berbagai Macam Jenis Produk Kami');
$subheading = hv($home, 'categoriesSubheading', 'Telusuri kategori bahan baku unggulan dari PGA, mulai dari bahan makanan hingga lainnya.');
?>
<section class="relative overflow-hidden bg-primary py-20 px-6">
    <div class="section-motif bg-motif-dots opacity-20"></div>
    <div class="pointer-events-none absolute -right-16 -top-16 h-72 w-72 rounded-full border-[10px] border-white/10"></div>
    <div class="pointer-events-none absolute -left-10 bottom-0 h-44 w-44 rounded-full border-[8px] border-white/10"></div>
    <div class="relative mx-auto max-w-site">
        <div class="text-center max-w-2xl mx-auto mb-14 text-white" data-aos="fade-up">
            <h2 class="font-heading font-bold text-3xl md:text-4xl mb-3"><?= esc($heading) ?></h2>
            <p class="text-white/75"><?= esc($subheading) ?></p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($homeCategories as $i => $cat): ?>
                <div class="category-card group relative overflow-hidden rounded-3xl bg-white/95" data-aos="fade-up" data-aos-delay="<?= $i * 90 ?>">
                    <div class="relative aspect-[4/5] overflow-hidden">
                        <img src="<?= base_url($cat['image']) ?>" alt="<?= esc($cat['name']) ?>" loading="lazy" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-5 text-white">
                            <h3 class="font-heading font-bold text-lg mb-1"><?= esc($cat['name']) ?></h3>
                            <?php if (! empty($cat['description'])): ?>
                                <p class="text-xs text-white/80 leading-relaxed max-h-0 overflow-hidden opacity-0 transition-all duration-300 group-hover:max-h-20 group-hover:opacity-100"><?= esc($cat['description']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
