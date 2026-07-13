<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = ! empty($item['id']);
$errors = session('errors') ?? [];
?>
<div class="w-full space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900"><?= esc($title ?? ($isEdit ? 'Edit ' . $moduleTitle : 'Tambah ' . $moduleTitle)) ?></h2>
        <a href="<?= site_url($redirectUrl) ?>" class="admin-btn-secondary">Kembali</a>
    </div>

    <form method="post" enctype="multipart/form-data"
          action="<?= $isEdit ? site_url($redirectUrl . '/' . $item['id']) : site_url($redirectUrl) ?>"
          class="w-full rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <label class="mb-1 block text-sm font-semibold text-slate-700">Nama <?= esc($moduleTitle) ?></label>
                <input type="text" name="title" required value="<?= esc(old('title', $item['title'] ?? '')) ?>" placeholder="Judul <?= esc($moduleTitle) ?>" class="admin-input <?= isset($errors['title']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                <?php if (isset($errors['title'])): ?>
                    <p class="mt-1 text-xs text-rose-600"><?= esc($errors['title']) ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Tanggal</label>
                <input type="date" name="published_at" value="<?= esc($item['published_at'] ? date('Y-m-d', strtotime($item['published_at'])) : date('Y-m-d')) ?>" class="admin-input">
            </div>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="admin-input">
                    <option value="draft" <?= ($item['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="published" <?= ($item['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Update By</label>
                <input type="text" value="<?= esc($item['updated_by'] ?? 'Admin') ?>" disabled class="admin-input bg-slate-50 text-slate-400">
            </div>
        </div>

        <div class="mt-5">
            <label class="mb-1 block text-sm font-semibold text-slate-700">Deskripsi</label>
            <textarea name="content" class="tinymce-editor w-full" rows="14"><?= $item['content'] ?? '' ?></textarea>
        </div>

        <?php if ($moduleTitle === 'Recipe'): ?>
            <div class="mt-5">
                <label class="mb-1 block text-sm font-semibold text-slate-700">URL Embed Video</label>
                <input type="text" name="video_url" value="<?= esc(old('video_url', $item['video_url'] ?? '')) ?>" placeholder="https://www.youtube.com/watch?v=... atau https://www.instagram.com/reel/..." class="admin-input">
                <p class="mt-1 text-xs text-slate-400">Cukup tempel link video-nya saja (link YouTube atau link Instagram Reel/Post) — <strong>bukan</strong> kode embed/blockquote. Akan ditampilkan berdampingan dengan deskripsi di halaman detail resep.</p>
            </div>
        <?php endif; ?>

        <?php if ($moduleTitle === 'Recipe' && isset($allProducts)): ?>
            <div class="mt-5">
                <label class="mb-2 block text-sm font-semibold text-slate-700">Produk Terkait</label>
                <p class="mb-3 text-xs text-slate-400">Pilih produk yang digunakan dalam resep ini — akan tampil sebagai "Resep Terkait" di halaman produk tersebut.</p>
                <div class="grid grid-cols-1 gap-2 rounded-2xl border border-slate-200 p-4 sm:grid-cols-2 lg:grid-cols-3 max-h-64 overflow-y-auto">
                    <?php foreach ($allProducts as $p): ?>
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="products[]" value="<?= esc((string) $p['id']) ?>"
                                   <?= in_array((int) $p['id'], $selectedProductIds ?? [], true) ? 'checked' : '' ?>
                                   class="rounded border-slate-300 text-red-600 focus:ring-red-400">
                            <?= esc($p['name']) ?>
                        </label>
                    <?php endforeach; ?>
                    <?php if (empty($allProducts)): ?>
                        <p class="text-sm text-slate-400">Belum ada data produk.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-5">
            <label class="mb-1 block text-sm font-semibold text-slate-700">Foto/Gambar</label>

            <?php if ($isEdit && ! empty($item['featured_image'])): ?>
                <div class="mb-3 inline-block overflow-hidden rounded-xl border border-slate-200">
                    <img src="<?= base_url($item['featured_image']) ?>" class="h-32 w-44 object-cover">
                </div>
            <?php endif; ?>

            <div class="upload-form space-y-3">
                <div class="upload-dropzone group relative overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-gradient-to-br from-slate-50 to-white px-4 py-10 text-center transition hover:border-red-300 hover:from-red-50/60">
                    <div class="pointer-events-none mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-red-100 text-red-600 shadow-sm transition group-hover:scale-110">
                        <svg viewBox="0 0 24 24" class="h-7 w-7 fill-current">
                            <path d="M12 3 7 8h3v6h4V8h3l-5-5Zm-7 14v2h14v-2H5Z" />
                        </svg>
                    </div>
                    <p class="pointer-events-none mt-3 text-sm font-semibold text-slate-700">Seret &amp; lepas foto di sini</p>
                    <p class="pointer-events-none text-xs text-slate-400">atau klik tombol di bawah — JPG, PNG, WEBP (1 foto)</p>
                    <button type="button" class="upload-browse-btn relative z-10 mt-4 inline-flex items-center gap-2 rounded-full bg-red-600 px-5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M11 4h2v16h-2V4Zm-7 7h16v2H4v-2Z" /></svg>
                        Pilih File
                    </button>
                    <input type="file" name="featured_image_file" accept="image/jpeg,image/png,image/webp" class="upload-input hidden">
                </div>

                <div class="upload-count hidden text-xs font-medium text-red-700"></div>
                <div class="upload-preview grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6"></div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <a href="<?= site_url($redirectUrl) ?>" class="admin-btn-secondary">Batal</a>
            <button type="submit" class="admin-btn-primary"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan ' . esc($moduleTitle) ?></button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
