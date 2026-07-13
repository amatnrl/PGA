<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" action="<?= isset($item['id']) ? site_url('admin/team-members/' . $item['id']) : site_url('admin/team-members') ?>" class="bg-white rounded-xl border border-gray-200 p-6 max-w-xl space-y-5">
    <?= csrf_field() ?>
    <div>
        <label class="block text-sm font-medium mb-1">Nama</label>
        <input type="text" name="name" required value="<?= esc(old('name', $item['name'] ?? '')) ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Jabatan</label>
        <input type="text" name="position" value="<?= esc($item['position'] ?? '') ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Foto (path/URL)</label>
        <input type="text" name="photo" value="<?= esc($item['photo'] ?? '') ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Urutan</label>
            <input type="number" name="sort_order" value="<?= esc((string) ($item['sort_order'] ?? 0)) ?>" class="w-full rounded-lg border-gray-300 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full rounded-lg border-gray-300 text-sm">
                <option value="active" <?= ($item['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= ($item['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
    </div>
    <div class="pt-2 flex gap-3">
        <button class="rounded-full bg-primary text-white text-sm font-semibold px-6 py-2.5 hover:bg-primary-dark">Simpan</button>
        <a href="<?= site_url('admin/team-members') ?>" class="rounded-full border border-gray-300 text-sm font-semibold px-6 py-2.5">Batal</a>
    </div>
</form>
<?= $this->endSection() ?>
