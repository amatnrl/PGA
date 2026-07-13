<?php /** @var array<int, array{label: string, url?: string}> $breadcrumbs */ ?>
<nav class="text-sm text-gray-500 mb-6" aria-label="breadcrumb">
    <ol class="flex items-center gap-2 flex-wrap">
        <?php foreach ($breadcrumbs as $i => $crumb): ?>
            <li class="flex items-center gap-2">
                <?php if (! empty($crumb['url']) && $i < count($breadcrumbs) - 1): ?>
                    <a href="<?= $crumb['url'] ?>" class="hover:text-primary"><?= esc($crumb['label']) ?></a>
                <?php else: ?>
                    <span class="text-accent-black font-medium"><?= esc($crumb['label']) ?></span>
                <?php endif; ?>
                <?php if ($i < count($breadcrumbs) - 1): ?><span>/</span><?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
