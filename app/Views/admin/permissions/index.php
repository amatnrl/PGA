<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4 rounded-lg bg-amber-50 border border-amber-200 text-amber-700 text-sm px-4 py-3">
    Struktur grup & permission bersifat tetap sesuai kebutuhan bisnis PGA (Super Admin / Admin / Editor). Halaman ini bersifat read-only. Hubungi developer untuk menambah permission baru.
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-left">
            <tr>
                <th class="px-4 py-3">Permission</th>
                <?php foreach ($groups as $key => $g): ?>
                    <th class="px-4 py-3 text-center"><?= esc($g['title']) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($permissions as $permKey => $permLabel): ?>
                <tr>
                    <td class="px-4 py-3">
                        <div class="font-medium"><?= esc($permKey) ?></div>
                        <div class="text-xs text-gray-400"><?= esc($permLabel) ?></div>
                    </td>
                    <?php foreach ($groups as $groupKey => $g): ?>
                        <?php
                        $allowed = false;
                        foreach ($matrix[$groupKey] ?? [] as $rule) {
                            $prefix = rtrim($rule, '*');
                            if ($rule === $permKey || ($rule !== $prefix && str_starts_with($permKey, $prefix))) {
                                $allowed = true;
                                break;
                            }
                        }
                        ?>
                        <td class="px-4 py-3 text-center"><?= $allowed ? '<span class="text-green-600">✔</span>' : '<span class="text-gray-300">—</span>' ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
