<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
$isEdit = isset($item['id']);
$errors = session('errors') ?? [];
?>
<div class="w-full space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900"><?= esc($title ?? ($isEdit ? 'Edit User' : 'Tambah User')) ?></h2>
        <a href="<?= site_url('admin/users') ?>" class="admin-btn-secondary">Kembali</a>
    </div>

    <form method="post" action="<?= $isEdit ? site_url('admin/users/' . $item['id']) : site_url('admin/users') ?>"
          class="w-full max-w-2xl rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <?= csrf_field() ?>

        <?php if (! $isEdit): ?>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Username</label>
                    <input type="text" name="username" required value="<?= esc(old('username', $item['username'] ?? '')) ?>" class="admin-input <?= isset($errors['username']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                    <?php if (isset($errors['username'])): ?>
                        <p class="mt-1 text-xs text-rose-600"><?= esc($errors['username']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" required value="<?= esc(old('email', $item['email'] ?? '')) ?>" class="admin-input <?= isset($errors['email']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                    <?php if (isset($errors['email'])): ?>
                        <p class="mt-1 text-xs text-rose-600"><?= esc($errors['email']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="mb-5 flex items-center gap-3 rounded-xl bg-slate-50 p-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-red-500 to-indigo-600 text-xs font-semibold text-white">
                    <?= esc(strtoupper(substr($item['username'], 0, 1))) ?>
                </div>
                <p class="text-sm text-slate-600"><?= esc($item['username']) ?> &mdash; <?= esc($item['email']) ?></p>
            </div>
        <?php endif; ?>

        <div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Password <?= $isEdit ? '(isi untuk reset)' : '' ?></label>
                <input type="password" name="password" <?= $isEdit ? '' : 'required' ?> class="admin-input <?= isset($errors['password']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                <?php if (isset($errors['password'])): ?>
                    <p class="mt-1 text-xs text-rose-600"><?= esc($errors['password']) ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Group</label>
                <select name="group" required class="admin-input <?= isset($errors['group']) ? 'border-rose-300 ring-rose-100' : '' ?>">
                    <?php foreach ($groups as $g): ?>
                        <option value="<?= $g ?>" <?= ($item['group'] ?? '') === $g ? 'selected' : '' ?>><?= ucfirst($g) ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['group'])): ?>
                    <p class="mt-1 text-xs text-rose-600"><?= esc($errors['group']) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <a href="<?= site_url('admin/users') ?>" class="admin-btn-secondary">Batal</a>
            <button type="submit" class="admin-btn-primary">Simpan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
