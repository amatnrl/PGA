<?php
/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(1);
?>
<nav aria-label="<?= lang('Pager.pageNavigation') ?>" class="flex flex-wrap items-center justify-between gap-3">
    <p class="text-xs text-slate-500">
        Halaman <span class="font-semibold text-slate-700"><?= $pager->getCurrentPageNumber() ?></span>
        dari <span class="font-semibold text-slate-700"><?= $pager->getLastPageNumber() ?></span>
    </p>

    <ul class="inline-flex items-center gap-1.5">
        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M15.4 7.4 14 6l-6 6 6 6 1.4-1.4L10.8 12l4.6-4.6Z" /></svg>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li>
                <a href="<?= $link['uri'] ?>"
                    class="inline-flex h-8 min-w-8 items-center justify-center rounded-lg px-2.5 text-sm font-medium transition <?= $link['active'] ? 'bg-red-600 text-white shadow-sm shadow-red-500/30' : 'text-slate-600 hover:bg-slate-100' ?>">
                    <?= esc((string) $link['title']) ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li>
                <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M8.6 7.4 10 6l6 6-6 6-1.4-1.4L13.2 12 8.6 7.4Z" /></svg>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
