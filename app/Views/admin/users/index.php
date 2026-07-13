<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-5">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-900">User Management</h2>
            <p class="text-sm text-slate-500">Kelola akun admin yang dapat masuk ke CMS ini.</p>
        </div>

        <a href="<?= site_url('admin/users/create') ?>" class="admin-btn-primary whitespace-nowrap">
            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M11 4h2v16h-2V4Zm-7 7h16v2H4v-2Z" /></svg>
            <span>Tambah User</span>
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Group</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($items as $item): ?>
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-red-500 to-rose-700 text-xs font-semibold text-white">
                                        <?= esc(strtoupper(substr($item['username'], 0, 1))) ?>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-700"><?= esc($item['username']) ?></p>
                                        <p class="text-xs text-slate-400"><?= esc($item['email'] ?? '-') ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-slate-500"><?= esc(implode(', ', $item['groups'] ?? [])) ?></td>
                            <td class="px-4 py-3">
                                <span class="<?= $item['active'] ? 'admin-badge-success' : 'admin-badge-warning' ?>"><?= $item['active'] ? 'Active' : 'Inactive' ?></span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="inline-flex items-center justify-end gap-2">
                                    <a href="<?= site_url('admin/users/' . $item['id'] . '/edit') ?>" title="Edit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-700 transition hover:bg-red-200">
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M4 17.25V20h2.75L14.81 11.94l-2.75-2.75L4 17.25Zm14.71-9.04a1 1 0 0 0 0-1.42l-1.5-1.5a1 1 0 0 0-1.42 0l-1.17 1.17 2.75 2.75 1.34-1.34Z" /></svg>
                                    </a>
                                    <form action="<?= site_url('admin/users/' . $item['id'] . '/delete') ?>" method="post" data-confirm="Hapus user ini?">
                                        <?= csrf_field() ?>
                                        <button type="submit" title="Hapus" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100 text-rose-700 transition hover:bg-rose-200">
                                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M6 7h12v2H6V7Zm2 3h8l-.9 9.1a1 1 0 0 1-1 .9H9.9a1 1 0 0 1-1-.9L8 10Zm2.5-6h3a1 1 0 0 1 1 1v1h-5V5a1 1 0 0 1 1-1Z" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($items)): ?>
                        <tr><td colspan="4" class="px-4 py-10 text-center text-slate-400">Belum ada data user.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
