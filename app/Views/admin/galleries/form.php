<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" action="<?= isset($item['id']) ? site_url('admin/galleries/' . $item['id']) : site_url('admin/galleries') ?>" class="bg-white rounded-xl border border-gray-200 p-6 max-w-xl space-y-5">
    <?= csrf_field() ?>
    <div>
        <label class="block text-sm font-medium mb-1">Kategori</label>
        <select name="category" class="w-full rounded-lg border-gray-300 text-sm">
            <option value="factory" <?= ($item['category'] ?? 'factory') === 'factory' ? 'selected' : '' ?>>Gudang/Factory</option>
            <option value="office" <?= ($item['category'] ?? '') === 'office' ? 'selected' : '' ?>>Kantor</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Gambar (path/URL)</label>
        <input type="text" name="image" required value="<?= esc($item['image'] ?? '') ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Caption</label>
        <input type="text" name="caption" value="<?= esc($item['caption'] ?? '') ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Urutan</label>
        <input type="number" name="sort_order" value="<?= esc((string) ($item['sort_order'] ?? 0)) ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div class="pt-2 flex gap-3">
        <button class="rounded-full bg-primary text-white text-sm font-semibold px-6 py-2.5 hover:bg-primary-dark">Simpan</button>
        <a href="<?= site_url('admin/galleries') ?>" class="rounded-full border border-gray-300 text-sm font-semibold px-6 py-2.5">Batal</a>
    </div>
</form>
<?= $this->endSection() ?>
