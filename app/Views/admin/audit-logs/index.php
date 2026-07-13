<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="get" class="mb-5">
    <select name="model" onchange="this.form.submit()" class="rounded-lg border-gray-300 text-sm">
        <option value="">Semua Model</option>
        <?php foreach ($models as $m): ?>
            <option value="<?= esc($m['model']) ?>" <?= ($_GET['model'] ?? '') === $m['model'] ? 'selected' : '' ?>><?= esc($m['model']) ?></option>
        <?php endforeach; ?>
    </select>
</form>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-left">
            <tr><th class="px-4 py-3">Waktu</th><th class="px-4 py-3">User</th><th class="px-4 py-3">Aksi</th><th class="px-4 py-3">Model</th><th class="px-4 py-3">IP</th></tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($items as $log): ?>
                <tr>
                    <td class="px-4 py-3 text-gray-500"><?= esc($log['created_at']) ?></td>
                    <td class="px-4 py-3"><?= esc((string) ($log['user_id'] ?? '-')) ?></td>
                    <td class="px-4 py-3"><span class="rounded-full px-2 py-0.5 text-xs bg-gray-100"><?= esc($log['action']) ?></span></td>
                    <td class="px-4 py-3"><?= esc($log['model']) ?> <?= $log['model_id'] ? '#' . $log['model_id'] : '' ?></td>
                    <td class="px-4 py-3 text-gray-400"><?= esc($log['ip_address'] ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($items)): ?><tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada log.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?= $pager->links() ?></div>
<?= $this->endSection() ?>
