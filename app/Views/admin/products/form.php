<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = ! empty($item['id']);
$errors = session('errors') ?? [];
$tabs   = ['basic' => 'Info Dasar', 'description' => 'Deskripsi', 'gallery' => 'Foto Produk', 'results' => 'Foto Hasil Produk', 'marketplace' => 'Marketplace'];
?>
<div class="w-full space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900"><?= esc($title ?? ($isEdit ? 'Edit Produk' : 'Tambah Produk')) ?></h2>
        <a href="<?= site_url('admin/products') ?>" class="admin-btn-secondary">Kembali</a>
    </div>

    <div class="flex gap-1 overflow-x-auto rounded-xl bg-slate-100 p-1" id="productTabs">
        <?php foreach ($tabs as $key => $label): ?>
            <button type="button" data-tab="<?= $key ?>" class="tab-btn whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium text-slate-500 transition <?= $key === 'basic' ? 'bg-white text-red-700 shadow-sm' : '' ?>"><?= $label ?></button>
        <?php endforeach; ?>
    </div>

    <form method="post" enctype="multipart/form-data"
          action="<?= $isEdit ? site_url('admin/products/' . $item['id']) : site_url('admin/products') ?>"
          class="w-full rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <?= csrf_field() ?>

        <div data-tab-panel="basic" class="tab-panel space-y-5">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Nama Produk</label>
                    <input type="text" name="name" required value="<?= esc(old('name', $item['name'] ?? '')) ?>" placeholder="Contoh: Tepung Tapioka Rumah Kelinci" class="admin-input <?= isset($errors['name']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                    <?php if (isset($errors['name'])): ?>
                        <p class="mt-1 text-xs text-rose-600"><?= esc($errors['name']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Jenis Produk</label>
                    <select name="type" required class="admin-input <?= isset($errors['type']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                        <?php foreach ($types as $key => $label): ?>
                            <option value="<?= esc($key) ?>" <?= old('type', $item['type'] ?? '') === $key ? 'selected' : '' ?>><?= esc($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['type'])): ?>
                        <p class="mt-1 text-xs text-rose-600"><?= esc($errors['type']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Status</label>
                    <select name="status" class="admin-input">
                        <option value="active" <?= ($item['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= ($item['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
            <?php if ($isEdit): ?>
                <p class="text-xs text-slate-400">Tandai sebagai Produk Unggulan dari kolom "Unggulan" di halaman daftar produk.</p>
            <?php endif; ?>
        </div>

        <div data-tab-panel="description" class="tab-panel hidden">
            <label class="mb-1 block text-sm font-semibold text-slate-700">Deskripsi Produk</label>
            <textarea name="description" class="tinymce-editor w-full" rows="14"><?= $item['description'] ?? '' ?></textarea>
        </div>

        <div data-tab-panel="gallery" class="tab-panel hidden">
            <p class="mb-3 text-sm text-slate-500">Foto utama produk (kemasan/bahan baku) — hanya satu foto. Mengupload foto baru akan otomatis menggantikan foto yang lama.</p>

            <?php if ($isEdit && ! empty($images)): ?>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6">
                    <?php foreach ($images as $img): ?>
                        <div class="relative overflow-hidden rounded-xl border border-slate-200">
                            <img src="<?= base_url($img['path']) ?>" class="h-28 w-full object-cover">
                            <?php if ($img['is_primary']): ?><span class="absolute left-1 top-1 rounded bg-red-600 px-1.5 text-[10px] font-semibold text-white">Utama</span><?php endif; ?>
                            <button type="button"
                                    class="absolute right-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white/90 text-rose-600 shadow-sm"
                                    data-confirm="Hapus foto ini?"
                                    data-delete-url="<?= site_url('admin/products/' . $item['id'] . '/images/' . $img['id'] . '/delete') ?>"
                                    data-csrf-name="<?= csrf_token() ?>"
                                    data-csrf-value="<?= csrf_hash() ?>">✕</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="upload-form mt-4 space-y-3<?= $isEdit ? ' border-t border-slate-100 pt-4' : '' ?>">
                <div class="upload-dropzone group relative overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-gradient-to-br from-slate-50 to-white px-4 py-10 text-center transition hover:border-red-300 hover:from-red-50/60">
                    <div class="pointer-events-none mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-red-100 text-red-600 shadow-sm transition group-hover:scale-110">
                        <svg viewBox="0 0 24 24" class="h-7 w-7 fill-current">
                            <path d="M12 3 7 8h3v6h4V8h3l-5-5Zm-7 14v2h14v-2H5Z" />
                        </svg>
                    </div>
                    <p class="pointer-events-none mt-3 text-sm font-semibold text-slate-700">Seret &amp; lepas foto produk di sini</p>
                    <p class="pointer-events-none text-xs text-slate-400">atau klik tombol di bawah — JPG, PNG, WEBP, hanya 1 foto</p>
                    <button type="button" class="upload-browse-btn relative z-10 mt-4 inline-flex items-center gap-2 rounded-full bg-red-600 px-5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M11 4h2v16h-2V4Zm-7 7h16v2H4v-2Z" /></svg>
                        Pilih File
                    </button>
                    <input type="file" name="new_images" accept="image/jpeg,image/png,image/webp" class="upload-input hidden">
                </div>

                <div class="upload-count hidden text-xs font-medium text-red-700"></div>
                <div class="upload-preview grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6"></div>

                <p class="text-xs text-slate-400">Foto akan diupload otomatis saat Anda menekan tombol "<?= $isEdit ? 'Simpan Perubahan' : 'Simpan Produk' ?>" di bawah.</p>
            </div>
        </div>

        <div data-tab-panel="results" class="tab-panel hidden">
            <p class="mb-3 text-sm text-slate-500">Foto makanan/minuman jadi yang menggunakan bahan ini — boleh upload beberapa foto sekaligus.</p>

            <?php if ($isEdit && ! empty($results)): ?>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6">
                    <?php foreach ($results as $img): ?>
                        <div class="relative overflow-hidden rounded-xl border border-slate-200">
                            <img src="<?= base_url($img['path']) ?>" class="h-28 w-full object-cover">
                            <button type="button"
                                    class="absolute right-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white/90 text-rose-600 shadow-sm"
                                    data-confirm="Hapus foto ini?"
                                    data-delete-url="<?= site_url('admin/products/' . $item['id'] . '/images/' . $img['id'] . '/delete') ?>"
                                    data-csrf-name="<?= csrf_token() ?>"
                                    data-csrf-value="<?= csrf_hash() ?>">✕</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="upload-form mt-4 space-y-3<?= $isEdit ? ' border-t border-slate-100 pt-4' : '' ?>">
                <div class="upload-dropzone group relative overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-gradient-to-br from-slate-50 to-white px-4 py-10 text-center transition hover:border-amber-300 hover:from-amber-50/60">
                    <div class="pointer-events-none mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 shadow-sm transition group-hover:scale-110">
                        <svg viewBox="0 0 24 24" class="h-7 w-7 fill-current">
                            <path d="M12 3 7 8h3v6h4V8h3l-5-5Zm-7 14v2h14v-2H5Z" />
                        </svg>
                    </div>
                    <p class="pointer-events-none mt-3 text-sm font-semibold text-slate-700">Seret &amp; lepas foto hasil produk di sini</p>
                    <p class="pointer-events-none text-xs text-slate-400">atau klik tombol di bawah — JPG, PNG, WEBP, bisa pilih banyak sekaligus</p>
                    <button type="button" class="upload-browse-btn relative z-10 mt-4 inline-flex items-center gap-2 rounded-full bg-amber-500 px-5 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M11 4h2v16h-2V4Zm-7 7h16v2H4v-2Z" /></svg>
                        Pilih File
                    </button>
                    <input type="file" name="new_result_images[]" multiple accept="image/jpeg,image/png,image/webp" class="upload-input hidden">
                </div>

                <div class="upload-count hidden text-xs font-medium text-amber-700"></div>
                <div class="upload-preview grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6"></div>

                <p class="text-xs text-slate-400">Foto akan diupload otomatis saat Anda menekan tombol "<?= $isEdit ? 'Simpan Perubahan' : 'Simpan Produk' ?>" di bawah.</p>
            </div>
        </div>

        <div data-tab-panel="marketplace" class="tab-panel hidden">
            <p class="mb-4 text-sm text-slate-500">Kosongkan jika belum tersedia — tombol akan otomatis tersembunyi di halaman publik.</p>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Link Shopee</label>
                    <input type="text" name="marketplace[shopee]" value="<?= esc($marketplace['shopee'] ?? '') ?>" placeholder="https://shopee.co.id/..." class="admin-input">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Link Tokopedia</label>
                    <input type="text" name="marketplace[tokopedia]" value="<?= esc($marketplace['tokopedia'] ?? '') ?>" placeholder="https://tokopedia.com/..." class="admin-input">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Link TikTok Shop</label>
                    <input type="text" name="marketplace[tiktok]" value="<?= esc($marketplace['tiktok'] ?? '') ?>" placeholder="https://tiktokshop.com/..." class="admin-input">
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <a href="<?= site_url('admin/products') ?>" class="admin-btn-secondary">Batal</a>
            <button type="submit" class="admin-btn-primary"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan Produk' ?></button>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('#productTabs .tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('#productTabs .tab-btn').forEach(b => b.classList.remove('bg-white', 'text-red-700', 'shadow-sm'));
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
        btn.classList.add('bg-white', 'text-red-700', 'shadow-sm');
        document.querySelector(`[data-tab-panel="${btn.dataset.tab}"]`).classList.remove('hidden');
    });
});
</script>
<?= $this->endSection() ?>
