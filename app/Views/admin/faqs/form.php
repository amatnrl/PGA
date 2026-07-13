<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = ! empty($item['id']);
$errors = session('errors') ?? [];
?>
<div class="w-full space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900"><?= esc($title ?? ($isEdit ? 'Edit FAQ' : 'Tambah FAQ')) ?></h2>
        <a href="<?= site_url('admin/faqs') ?>" class="admin-btn-secondary">Kembali</a>
    </div>

    <form method="post"
          action="<?= $isEdit ? site_url('admin/faqs/' . $item['id']) : site_url('admin/faqs') ?>"
          class="w-full rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <label class="mb-1 block text-sm font-semibold text-slate-700">Pertanyaan</label>
                <input type="text" name="question" required value="<?= esc(old('question', $item['question'] ?? '')) ?>" class="admin-input <?= isset($errors['question']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                <?php if (isset($errors['question'])): ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['question']) ?></p><?php endif; ?>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Kategori (opsional)</label>
                <input type="text" name="category" value="<?= esc($item['category'] ?? '') ?>" class="admin-input">
            </div>
        </div>

        <div class="mt-5">
            <label class="mb-1 block text-sm font-semibold text-slate-700">Jawaban</label>
            <textarea name="answer" rows="4" required class="admin-input <?= isset($errors['answer']) ? 'border-rose-300 ring-rose-100' : '' ?>"><?= esc($item['answer'] ?? '') ?></textarea>
            <?php if (isset($errors['answer'])): ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['answer']) ?></p><?php endif; ?>
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

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <a href="<?= site_url('admin/faqs') ?>" class="admin-btn-secondary">Batal</a>
            <button type="submit" class="admin-btn-primary"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan FAQ' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
