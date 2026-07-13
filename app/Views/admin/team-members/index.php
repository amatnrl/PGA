<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<a href="<?= site_url('admin/settings') ?>" class="text-sm text-gray-500 hover:text-primary">&larr; Kembali ke Setting</a>
<div class="flex items-center justify-between mb-5 mt-3">
    <h2 class="font-heading font-semibold">Team Member</h2>
    <a href="<?= site_url('admin/team-members/create') ?>" class="rounded-full bg-primary text-white text-sm font-semibold px-5 py-2.5 hover:bg-primary-dark">+ Tambah</a>
</div>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-left"><tr><th class="px-4 py-3">Foto</th><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Jabatan</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Aksi</th></tr></thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($items as $item): ?>
                <tr>
                    <td class="px-4 py-3"><?php if (! empty($item['photo'])): ?><img src="<?= base_url($item['photo']) ?>" class="w-10 h-10 rounded-full object-cover"><?php endif; ?></td>
                    <td class="px-4 py-3 font-medium"><?= esc($item['name']) ?></td>
                    <td class="px-4 py-3 text-gray-500"><?= esc($item['position'] ?? '-') ?></td>
                    <td class="px-4 py-3"><span class="rounded-full px-2.5 py-0.5 text-xs <?= $item['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' ?>"><?= esc($item['status']) ?></span></td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="<?= site_url('admin/team-members/' . $item['id'] . '/edit') ?>" class="text-primary hover:underline">Edit</a>
                        <form action="<?= site_url('admin/team-members/' . $item['id'] . '/delete') ?>" method="post" class="inline" data-confirm="Hapus?">
                            <?= csrf_field() ?><button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($items)): ?><tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada data.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?= $pager->links() ?></div>
<?= $this->endSection() ?>
