<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" action="<?= isset($item['id']) ? site_url('admin/milestones/' . $item['id']) : site_url('admin/milestones') ?>" class="bg-white rounded-xl border border-gray-200 p-6 max-w-xl space-y-5">
    <?= csrf_field() ?>
    <div>
        <label class="block text-sm font-medium mb-1">Tahun</label>
        <input type="text" name="year" required value="<?= esc(old('year', $item['year'] ?? '')) ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Judul</label>
        <input type="text" name="title" required value="<?= esc(old('title', $item['title'] ?? '')) ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 text-sm"><?= esc($item['description'] ?? '') ?></textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Urutan</label>
        <input type="number" name="sort_order" value="<?= esc((string) ($item['sort_order'] ?? 0)) ?>" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div class="pt-2 flex gap-3">
        <button class="rounded-full bg-primary text-white text-sm font-semibold px-6 py-2.5 hover:bg-primary-dark">Simpan</button>
        <a href="<?= site_url('admin/milestones') ?>" class="rounded-full border border-gray-300 text-sm font-semibold px-6 py-2.5">Batal</a>
    </div>
</form>
<?= $this->endSection() ?>
