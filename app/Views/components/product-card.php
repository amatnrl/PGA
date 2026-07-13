<?php
/** @var array $product */
$typeLabel = \App\Models\ProductModel::TYPES[$product['type'] ?? ''] ?? '';
?>
<a href="<?= site_url('product/' . $product['slug']) ?>"
   class="product-card relative group block h-full"
   data-aos="fade-up">
    <span class="product-card-ghost product-card-ghost-1"></span>
    <span class="product-card-ghost product-card-ghost-2"></span>
    <div class="product-card-inner relative z-10 flex h-full flex-col bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="product-card-img relative aspect-square bg-gray-50 overflow-hidden">
            <img src="<?= $product['image'] ? base_url($product['image']) : 'https://placehold.co/400x400?text=PGA' ?>"
                 alt="<?= esc($product['name']) ?>" loading="lazy"
                 class="w-full h-full object-cover">
            <div class="btn-icon absolute inset-x-0 bottom-0 flex items-center justify-center gap-1.5 translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-primary text-white text-center text-xs font-semibold py-2">
                <span>Lihat Detail</span>
                <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
            </div>
        </div>
        <div class="p-4 flex-1 flex flex-col">
            <span class="text-[11px] font-semibold text-primary uppercase tracking-wide"><?= esc($typeLabel) ?></span>
            <h3 class="font-heading font-semibold text-sm mt-1 line-clamp-2 group-hover:text-primary transition-colors"><?= esc($product['name']) ?></h3>
        </div>
    </div>
</a>
