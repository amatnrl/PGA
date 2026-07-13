<?php
/**
 * @var array<string,string> $items  key => label
 * @var string               $baseUrl  e.g. 'product' or 'explore'
 * @var string               $param    query param name, e.g. 'type' (omit for path-based)
 */
$param = $param ?? null;
?>
<div class="absolute left-1/2 top-full w-72 -translate-x-1/2 pt-4 opacity-0 invisible scale-95 -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:scale-100 group-hover:translate-y-0 transition-all duration-300 ease-out origin-top z-40">
    <div class="relative overflow-hidden rounded-2xl bg-white border border-gray-100 shadow-2xl shadow-black/10 p-3">
        <?php $i = 0; foreach ($items as $key => $label): $i++; ?>
            <a href="<?= $param ? site_url($baseUrl . '?' . $param . '=' . $key) : site_url($baseUrl . '/' . $key) ?>"
               style="transition-delay: <?= $i * 40 ?>ms"
               class="dropdown-item group/item relative flex items-center justify-between rounded-xl px-4 py-2 text-xs font-semibold text-gray-700 opacity-0 -translate-y-1 hover:bg-gray-100 hover:text-accent-black hover:pl-5 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                <span><?= esc($label) ?></span>
                <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current opacity-0 -translate-x-1 group-hover/item:opacity-100 group-hover/item:translate-x-0 transition-all duration-200"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
            </a>
        <?php endforeach; ?>
    </div>
</div>
