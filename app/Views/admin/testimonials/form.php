<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = ! empty($item['id']);
$errors = session('errors') ?? [];
?>
<div class="w-full space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900"><?= esc($title ?? ($isEdit ? 'Edit Testimonial' : 'Tambah Testimonial')) ?></h2>
        <a href="<?= site_url('admin/testimonials') ?>" class="admin-btn-secondary">Kembali</a>
    </div>

    <form method="post" enctype="multipart/form-data"
          action="<?= $isEdit ? site_url('admin/testimonials/' . $item['id']) : site_url('admin/testimonials') ?>"
          class="w-full rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Nama Pelanggan</label>
                <input type="text" name="name" required value="<?= esc(old('name', $item['name'] ?? '')) ?>" class="admin-input <?= isset($errors['name']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                <?php if (isset($errors['name'])): ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['name']) ?></p><?php endif; ?>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Profesi/Keterangan</label>
                <input type="text" name="position" value="<?= esc($item['position'] ?? '') ?>" placeholder="Contoh: Pemilik Toko Roti" class="admin-input">
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Rating</label>
                <select name="rating" class="admin-input">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <option value="<?= $i ?>" <?= ($item['rating'] ?? 5) == $i ? 'selected' : '' ?>><?= $i ?> Bintang</option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="mt-5">
            <label class="mb-1 block text-sm font-semibold text-slate-700">Testimoni</label>
            <textarea name="content" rows="4" required class="admin-input <?= isset($errors['content']) ? 'border-rose-300 ring-rose-100' : '' ?>"><?= esc($item['content'] ?? '') ?></textarea>
            <?php if (isset($errors['content'])): ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['content']) ?></p><?php endif; ?>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Urutan</label>
                <input type="number" name="sort_order" value="<?= esc((string) ($item['sort_order'] ?? 0)) ?>" class="admin-input">
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="admin-input">
                    <option value="active" <?= ($item['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= ($item['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <div class="mt-5">
            <label class="mb-2 block text-sm font-semibold text-slate-700">Foto Pelanggan (opsional)</label>
            <?php if ($isEdit && ! empty($item['photo'])): ?>
                <div class="mb-3 inline-block overflow-hidden rounded-full border border-slate-200">
                    <img src="<?= base_url($item['photo']) ?>" class="h-20 w-20 object-cover">
                </div>
            <?php endif; ?>
            <div class="upload-form space-y-3">
                <div class="upload-dropzone group relative overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-gradient-to-br from-slate-50 to-white px-4 py-8 text-center transition hover:border-red-300 hover:from-red-50/60">
                    <div class="pointer-events-none mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600 shadow-sm transition group-hover:scale-110">
                        <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current"><path d="M12 3 7 8h3v6h4V8h3l-5-5Zm-7 14v2h14v-2H5Z" /></svg>
                    </div>
                    <p class="pointer-events-none mt-2 text-sm font-semibold text-slate-700">Seret &amp; lepas foto di sini</p>
                    <p class="pointer-events-none text-xs text-slate-400">atau klik tombol di bawah</p>
                    <button type="button" class="upload-browse-btn relative z-10 mt-3 inline-flex items-center gap-2 rounded-full bg-red-600 px-4 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">Pilih File</button>
                    <input type="file" name="photo_file" accept="image/jpeg,image/png,image/webp" class="upload-input hidden">
                </div>
                <div class="upload-count hidden text-xs font-medium text-red-700"></div>
                <div class="upload-preview grid grid-cols-2 gap-3 sm:grid-cols-4"></div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <a href="<?= site_url('admin/testimonials') ?>" class="admin-btn-secondary">Batal</a>
            <button type="submit" class="admin-btn-primary"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan Testimonial' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
