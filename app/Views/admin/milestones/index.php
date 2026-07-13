<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<a href="<?= site_url('admin/settings') ?>" class="text-sm text-gray-500 hover:text-primary">&larr; Kembali ke Setting</a>
<div class="flex items-center justify-between mb-5 mt-3">
    <h2 class="font-heading font-semibold">Timeline Perusahaan</h2>
    <a href="<?= site_url('admin/milestones/create') ?>" class="rounded-full bg-primary text-white text-sm font-semibold px-5 py-2.5 hover:bg-primary-dark">+ Tambah</a>
</div>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-left"><tr><th class="px-4 py-3">Tahun</th><th class="px-4 py-3">Judul</th><th class="px-4 py-3 text-right">Aksi</th></tr></thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($items as $item): ?>
                <tr>
                    <td class="px-4 py-3 font-medium"><?= esc($item['year']) ?></td>
                    <td class="px-4 py-3"><?= esc($item['title']) ?></td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="<?= site_url('admin/milestones/' . $item['id'] . '/edit') ?>" class="text-primary hover:underline">Edit</a>
                        <form action="<?= site_url('admin/milestones/' . $item['id'] . '/delete') ?>" method="post" class="inline" data-confirm="Hapus?">
                            <?= csrf_field() ?><button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($items)): ?><tr><td colspan="3" class="px-4 py-8 text-center text-gray-400">Belum ada data.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?= $pager->links() ?></div>
<?= $this->endSection() ?>
