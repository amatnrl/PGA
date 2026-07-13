<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = ! empty($item['id']);
$errors = session('errors') ?? [];
?>
<div class="w-full space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900"><?= esc($title ?? ($isEdit ? 'Edit Jalur Distribusi' : 'Tambah Jalur Distribusi')) ?></h2>
        <a href="<?= site_url('admin/branches') ?>" class="admin-btn-secondary">Kembali</a>
    </div>

    <form method="post" action="<?= $isEdit ? site_url('admin/branches/' . $item['id']) : site_url('admin/branches') ?>" class="w-full rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Wilayah</label>
                <input type="text" name="region" value="<?= esc(old('region', $item['region'] ?? '')) ?>" placeholder="Contoh: Sulawesi Selatan" class="admin-input <?= isset($errors['region']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                <?php if (isset($errors['region'])): ?>
                    <p class="mt-1 text-xs text-rose-600"><?= esc($errors['region']) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Wilayah Tujuan (Kota/Daerah)</label>
                <input type="text" name="city" value="<?= esc(old('city', $item['city'] ?? '')) ?>" placeholder="Contoh: Makassar" class="admin-input <?= isset($errors['city']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                <?php if (isset($errors['city'])): ?>
                    <p class="mt-1 text-xs text-rose-600"><?= esc($errors['city']) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="admin-input">
                    <?php $currentStatus = old('status', $item['status'] ?? 'active'); ?>
                    <option value="active" <?= $currentStatus === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $currentStatus === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <a href="<?= site_url('admin/branches') ?>" class="admin-btn-secondary">Batal</a>
            <button type="submit" class="admin-btn-primary"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan Jalur Distribusi' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>