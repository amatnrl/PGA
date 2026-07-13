<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-5">
    <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Backup Management</h2>
            <p class="max-w-xl text-sm text-slate-500">Backup mencakup database & seluruh file yang diupload (folder uploads). Restore bersifat manual oleh developer demi keamanan &mdash; download file lalu kembalikan ke server saat diperlukan.</p>
        </div>

        <form action="<?= site_url('admin/backups/create') ?>" method="post">
            <?= csrf_field() ?>
            <button type="submit" class="admin-btn-primary whitespace-nowrap">
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M11 4h2v16h-2V4Zm-7 7h16v2H4v-2Z" /></svg>
                <span>Buat Backup Baru</span>
            </button>
        </form>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-[0.12em] text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Nama File</th>
                        <th class="px-4 py-3">Ukuran</th>
                        <th class="px-4 py-3">Dibuat</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($backups as $b): ?>
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-4 py-3 font-mono text-xs text-slate-700"><?= esc($b['name']) ?></td>
                            <td class="px-4 py-3 text-slate-500"><?= number_format($b['size'] / 1024 / 1024, 2) ?> MB</td>
                            <td class="px-4 py-3 text-slate-500"><?= esc($b['created']) ?></td>
                            <td class="px-4 py-3 text-right">
                                <div class="inline-flex items-center justify-end gap-2">
                                    <a href="<?= site_url('admin/backups/' . $b['name'] . '/download') ?>" title="Download" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-700 transition hover:bg-red-200">
                                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M11 3h2v10.2l3.6-3.6 1.4 1.4-6 6-6-6 1.4-1.4 3.6 3.6V3ZM5 19h14v2H5v-2Z" /></svg>
                                    </a>
                                    <form action="<?= site_url('admin/backups/' . $b['name'] . '/delete') ?>" method="post" data-confirm="Hapus backup ini?">
                                        <?= csrf_field() ?>
                                        <button type="submit" title="Hapus" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100 text-rose-700 transition hover:bg-rose-200">
                                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M6 7h12v2H6V7Zm2 3h8l-.9 9.1a1 1 0 0 1-1 .9H9.9a1 1 0 0 1-1-.9L8 10Zm2.5-6h3a1 1 0 0 1 1 1v1h-5V5a1 1 0 0 1 1-1Z" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($backups)): ?>
                        <tr><td colspan="4" class="px-4 py-10 text-center text-slate-400">Belum ada backup.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
