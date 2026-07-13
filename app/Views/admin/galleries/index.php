<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<a href="<?= site_url('admin/settings') ?>" class="text-sm text-gray-500 hover:text-primary">&larr; Kembali ke Setting</a>
<div class="flex items-center justify-between mb-5 mt-3">
    <h2 class="font-heading font-semibold">Factory / Office Gallery</h2>
    <a href="<?= site_url('admin/galleries/create') ?>" class="rounded-full bg-primary text-white text-sm font-semibold px-5 py-2.5 hover:bg-primary-dark">+ Tambah</a>
</div>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
    <?php foreach ($items as $item): ?>
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <img src="<?= base_url($item['image']) ?>" class="w-full h-28 object-cover">
            <div class="p-2 text-xs text-gray-500"><?= esc($item['category']) ?> &mdash; <?= esc($item['caption'] ?? '') ?></div>
            <div class="flex p-2 gap-2">
                <a href="<?= site_url('admin/galleries/' . $item['id'] . '/edit') ?>" class="flex-1 text-xs text-center text-primary border border-primary rounded-lg py-1">Edit</a>
                <form action="<?= site_url('admin/galleries/' . $item['id'] . '/delete') ?>" method="post" class="flex-1" data-confirm="Hapus?">
                    <?= csrf_field() ?>
                    <button class="w-full text-xs text-white bg-red-600 rounded-lg py-1">Hapus</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (empty($items)): ?><p class="col-span-full text-center text-gray-400 py-10">Belum ada gallery.</p><?php endif; ?>
</div>
<div class="mt-4"><?= $pager->links() ?></div>
<?= $this->endSection() ?>
