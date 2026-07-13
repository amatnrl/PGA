<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-full space-y-5">
    <h2 class="text-lg font-semibold text-slate-900">Kontak</h2>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
        <form method="post" action="<?= site_url('admin/messages') ?>"
              class="w-full space-y-5 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
            <?= csrf_field() ?>

            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">No. WhatsApp</label>
                <input type="text" name="whatsapp" value="<?= esc($site['whatsapp'] ?? '') ?>" placeholder="6282293616520" class="admin-input">
                <p class="mt-1 text-xs text-slate-400">Format internasional tanpa "+" atau "0" di depan, contoh: 6282293616520.</p>
            </div>

            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email" value="<?= esc($site['email'] ?? '') ?>" placeholder="kontak@pga.co.id" class="admin-input">
            </div>

            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Alamat</label>
                <textarea name="address" id="addressInput" rows="3" placeholder="Jl. Contoh No.1, Kota, Provinsi" class="admin-input"><?= esc($site['address'] ?? '') ?></textarea>
            </div>

            <div class="flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
                <button type="submit" class="admin-btn-primary">Simpan Perubahan</button>
            </div>
        </form>

        <div class="w-full space-y-3 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
            <p class="text-sm font-semibold text-slate-700">Preview Maps</p>
            <p class="text-xs text-slate-400">Lokasi berdasarkan alamat yang tersimpan saat ini.</p>
            <div class="aspect-video overflow-hidden rounded-xl border border-slate-200">
                <iframe id="mapsPreview" src="https://www.google.com/maps?q=<?= rawurlencode($site['address'] ?? 'Indonesia') ?>&output=embed" class="h-full w-full" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('addressInput').addEventListener('blur', (e) => {
    const frame = document.getElementById('mapsPreview');
    frame.src = 'https://www.google.com/maps?q=' + encodeURIComponent(e.target.value || 'Indonesia') + '&output=embed';
});
</script>
<?= $this->endSection() ?>
