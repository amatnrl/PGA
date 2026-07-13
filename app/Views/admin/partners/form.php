<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = ! empty($item['id']);
$errors = session('errors') ?? [];
?>
<div class="w-full space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900"><?= esc($title ?? ($isEdit ? 'Edit Partner' : 'Tambah Partner')) ?></h2>
        <a href="<?= site_url('admin/partners') ?>" class="admin-btn-secondary">Kembali</a>
    </div>

    <form method="post" enctype="multipart/form-data"
          action="<?= $isEdit ? site_url('admin/partners/' . $item['id']) : site_url('admin/partners') ?>"
          class="w-full rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <label class="mb-1 block text-sm font-semibold text-slate-700">Nama Partner</label>
                <input type="text" name="name" required value="<?= esc(old('name', $item['name'] ?? '')) ?>" class="admin-input <?= isset($errors['name']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                <?php if (isset($errors['name'])): ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['name']) ?></p><?php endif; ?>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="admin-input">
                    <option value="active" <?= ($item['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= ($item['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <label class="mb-1 block text-sm font-semibold text-slate-700">Website (opsional)</label>
                <input type="text" name="website_url" value="<?= esc($item['website_url'] ?? '') ?>" placeholder="https://..." class="admin-input">
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Urutan</label>
                <input type="number" name="sort_order" value="<?= esc((string) ($item['sort_order'] ?? 0)) ?>" class="admin-input">
            </div>
        </div>

        <div class="mt-5">
            <label class="mb-2 block text-sm font-semibold text-slate-700">Logo</label>
            <?php if ($isEdit && ! empty($item['logo'])): ?>
                <div class="mb-3 inline-block overflow-hidden rounded-xl border border-slate-200">
                    <img src="<?= base_url($item['logo']) ?>" class="h-20 w-32 object-contain">
                </div>
            <?php endif; ?>
            <div class="upload-form space-y-3">
                <div class="upload-dropzone group relative overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-gradient-to-br from-slate-50 to-white px-4 py-8 text-center transition hover:border-red-300 hover:from-red-50/60">
                    <div class="pointer-events-none mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600 shadow-sm transition group-hover:scale-110">
                        <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current"><path d="M12 3 7 8h3v6h4V8h3l-5-5Zm-7 14v2h14v-2H5Z" /></svg>
                    </div>
                    <p class="pointer-events-none mt-2 text-sm font-semibold text-slate-700">Seret &amp; lepas logo di sini</p>
                    <p class="pointer-events-none text-xs text-slate-400">atau klik tombol di bawah</p>
                    <button type="button" class="upload-browse-btn relative z-10 mt-3 inline-flex items-center gap-2 rounded-full bg-red-600 px-4 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">Pilih File</button>
                    <input type="file" name="logo_file" accept="image/jpeg,image/png,image/webp" class="upload-input hidden">
                </div>
                <div class="upload-count hidden text-xs font-medium text-red-700"></div>
                <div class="upload-preview grid grid-cols-2 gap-3 sm:grid-cols-4"></div>
            </div>
            <?php if (isset($errors['logo'])): ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['logo']) ?></p><?php endif; ?>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <a href="<?= site_url('admin/partners') ?>" class="admin-btn-secondary">Batal</a>
            <button type="submit" class="admin-btn-primary"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan Partner' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
