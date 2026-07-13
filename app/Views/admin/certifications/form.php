<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" action="<?= isset($item['id']) ? site_url('admin/certifications/' . $item['id']) : site_url('admin/certifications') ?>" class="bg-white rounded-xl border border-gray-200 p-6 max-w-xl space-y-5">
    <?= csrf_field() ?>
    <div>
        <label class="block text-sm font-medium mb-1">Nama Sertifikasi/Penghargaan</label>
        <input type="text" name="name" required value="<?= esc(old('name', $item['name'] ?? '')) ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Gambar Badge (path/URL)</label>
        <input type="text" name="image" value="<?= esc($item['image'] ?? '') ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Tipe</label>
            <select name="type" class="w-full rounded-lg border-gray-300 text-sm">
                <option value="certification" <?= ($item['type'] ?? 'certification') === 'certification' ? 'selected' : '' ?>>Sertifikasi</option>
                <option value="award" <?= ($item['type'] ?? '') === 'award' ? 'selected' : '' ?>>Penghargaan</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tahun</label>
            <input type="text" name="issued_year" value="<?= esc($item['issued_year'] ?? '') ?>" class="w-full rounded-lg border-gray-300 text-sm">
        </div>
    </div>
    <div class="pt-2 flex gap-3">
        <button class="rounded-full bg-primary text-white text-sm font-semibold px-6 py-2.5 hover:bg-primary-dark">Simpan</button>
        <a href="<?= site_url('admin/certifications') ?>" class="rounded-full border border-gray-300 text-sm font-semibold px-6 py-2.5">Batal</a>
    </div>
</form>
<?= $this->endSection() ?>
