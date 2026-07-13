<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php $tabs = ['company' => 'Perusahaan', 'about' => 'About', 'home' => 'Homepage']; ?>
<div class="w-full space-y-5">
    <h2 class="text-lg font-semibold text-slate-900">Setting</h2>

    <div class="flex gap-1 overflow-x-auto rounded-xl bg-slate-100 p-1" id="settingTabs">
        <?php foreach ($tabs as $key => $label): ?>
            <button type="button" data-tab="<?= $key ?>" class="tab-btn whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium text-slate-500 transition <?= $key === 'company' ? 'bg-white text-red-700 shadow-sm' : '' ?>"><?= $label ?></button>
        <?php endforeach; ?>
    </div>

    <form method="post" action="<?= site_url('admin/settings') ?>" enctype="multipart/form-data" class="w-full rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <?= csrf_field() ?>

        <div data-tab-panel="company" class="tab-panel space-y-5">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Logo Perusahaan</label>
                    <div class="relative inline-block">
                        <div class="flex h-28 w-28 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                            <?php if (! empty($site['logo'])): ?>
                                <img id="logoPreviewImg" src="<?= base_url($site['logo']) ?>" class="h-full w-full object-cover">
                            <?php else: ?>
                                <img id="logoPreviewImg" src="" class="hidden h-full w-full object-cover">
                                <svg id="logoPlaceholderIcon" viewBox="0 0 24 24" class="h-10 w-10 fill-current text-slate-300"><path d="M4 5h16v14H4V5Zm2.2 2.2v9.6h11.6V7.2H6.2Zm2.2 7.2 2.3-2.8 1.8 2.2 2.6-3.2 2.7 3.8H8.4Z"/></svg>
                            <?php endif; ?>
                        </div>
                        <button type="button" id="logoChangeBtn" title="Ganti foto" class="absolute -bottom-1 -right-1 flex h-8 w-8 items-center justify-center rounded-full bg-red-600 text-white shadow-md ring-2 ring-white transition hover:bg-red-700">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M9 3h6l1.5 2H21v15H3V5h4.5L9 3Zm3 5.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9Zm0 2a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5Z"/></svg>
                        </button>
                        <input type="file" name="site_logo_file" id="logoFileInput" accept="image/jpeg,image/png,image/webp" class="hidden">
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Foto Perusahaan</label>
                    <div class="relative inline-block">
                        <div class="flex h-28 w-28 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                            <?php if (! empty($site['companyPhoto'])): ?>
                                <img id="companyPhotoPreviewImg" src="<?= base_url($site['companyPhoto']) ?>" class="h-full w-full object-cover">
                            <?php else: ?>
                                <img id="companyPhotoPreviewImg" src="" class="hidden h-full w-full object-cover">
                                <svg id="companyPhotoPlaceholderIcon" viewBox="0 0 24 24" class="h-10 w-10 fill-current text-slate-300"><path d="M4 5h16v14H4V5Zm2.2 2.2v9.6h11.6V7.2H6.2Zm2.2 7.2 2.3-2.8 1.8 2.2 2.6-3.2 2.7 3.8H8.4Z"/></svg>
                            <?php endif; ?>
                        </div>
                        <button type="button" id="companyPhotoChangeBtn" title="Ganti foto" class="absolute -bottom-1 -right-1 flex h-8 w-8 items-center justify-center rounded-full bg-red-600 text-white shadow-md ring-2 ring-white transition hover:bg-red-700">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current"><path d="M9 3h6l1.5 2H21v15H3V5h4.5L9 3Zm3 5.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9Zm0 2a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5Z"/></svg>
                        </button>
                        <input type="file" name="site_company_photo_file" id="companyPhotoFileInput" accept="image/jpeg,image/png,image/webp" class="hidden">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Nama Perusahaan</label>
                    <input type="text" name="site[companyName]" value="<?= esc($site['companyName'] ?? 'PT. Pancaran Gemilang Abadi') ?>" class="admin-input">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Tagline</label>
                    <input type="text" name="site[tagline]" value="<?= esc($site['tagline'] ?? '') ?>" class="admin-input">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Instagram</label>
                    <input type="text" name="site[instagramUrl]" value="<?= esc($site['instagramUrl'] ?? '') ?>" class="admin-input">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Facebook</label>
                    <input type="text" name="site[facebookUrl]" value="<?= esc($site['facebookUrl'] ?? '') ?>" class="admin-input">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">TikTok</label>
                    <input type="text" name="site[tiktokUrl]" value="<?= esc($site['tiktokUrl'] ?? '') ?>" class="admin-input">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Shopee</label>
                    <input type="text" name="site[shopeeUrl]" value="<?= esc($site['shopeeUrl'] ?? '') ?>" class="admin-input">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Tokopedia</label>
                    <input type="text" name="site[tokopediaUrl]" value="<?= esc($site['tokopediaUrl'] ?? '') ?>" class="admin-input">
                </div>
            </div>
        </div>

        <div data-tab-panel="about" class="tab-panel hidden space-y-5">
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Sejarah Perusahaan</label>
                <textarea name="about[history]" class="tinymce-editor w-full" rows="8"><?= $about['history'] ?? '' ?></textarea>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Visi</label>
                <textarea name="about[vision]" rows="2" class="admin-input"><?= esc($about['vision'] ?? '') ?></textarea>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Misi (1 baris = 1 poin)</label>
                <textarea name="about[missionList]" rows="4" class="admin-input"><?= esc($about['missionList'] ?? '') ?></textarea>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Intro Core Value</label>
                <textarea name="about[coreValueIntro]" rows="2" class="admin-input"><?= esc($about['coreValueIntro'] ?? '') ?></textarea>
            </div>
        </div>

        <div data-tab-panel="home" class="tab-panel hidden space-y-8">
            <div>
                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.1em] text-red-700">Section 2 — Profil Perusahaan</p>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Keterangan 1</label>
                        <textarea name="home[profileDesc1]" class="tinymce-editor w-full" rows="6"><?= $home['profileDesc1'] ?? '' ?></textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Gambar</label>
                        <?php if (! empty($home['profileImage'])): ?>
                            <div class="mb-3 overflow-hidden rounded-xl border border-slate-200">
                                <img src="<?= base_url($home['profileImage']) ?>" class="h-32 w-full object-cover">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="home_profile_image_file" accept="image/jpeg,image/png,image/webp" class="admin-input">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Keterangan 2</label>
                        <textarea name="home[profileDesc2]" class="tinymce-editor w-full" rows="6"><?= $home['profileDesc2'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.1em] text-red-700">Section 3 — Keunggulan</p>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Judul Section</label>
                        <input type="text" name="home[whyHeading]" value="<?= esc($home['whyHeading'] ?? 'Alasan Kenapa Kami Selalu Jadi Pilihan Utama') ?>" class="admin-input">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Sub Judul</label>
                        <input type="text" name="home[whySubheading]" value="<?= esc($home['whySubheading'] ?? '') ?>" class="admin-input">
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-3">
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <div class="rounded-xl border border-slate-200 p-4">
                            <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-slate-400">Item <?= $i ?></p>
                            <label class="mb-1 block text-xs font-semibold text-slate-700">Nama</label>
                            <input type="text" name="home[feature<?= $i ?>Name]" value="<?= esc($home["feature{$i}Name"] ?? '') ?>" class="admin-input mb-3">
                            <label class="mb-1 block text-xs font-semibold text-slate-700">Keterangan</label>
                            <textarea name="home[feature<?= $i ?>Desc]" rows="2" class="admin-input mb-3"><?= esc($home["feature{$i}Desc"] ?? '') ?></textarea>
                            <label class="mb-1 block text-xs font-semibold text-slate-700">Gambar</label>
                            <?php if (! empty($home["feature{$i}Image"])): ?>
                                <div class="mb-2 inline-block overflow-hidden rounded-lg border border-slate-200">
                                    <img src="<?= base_url($home["feature{$i}Image"]) ?>" class="h-14 w-14 object-cover">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="home_feature<?= $i ?>_image_file" accept="image/jpeg,image/png,image/webp" class="admin-input text-xs">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.1em] text-red-700">Section 4 — Kategori</p>
                <div>
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Judul Section</label>
                    <input type="text" name="home[categoriesHeading]" value="<?= esc($home['categoriesHeading'] ?? 'Berbagai Macam Jenis Produk Kami') ?>" class="admin-input max-w-md">
                </div>

                <p class="mt-5 mb-3 text-xs font-semibold uppercase tracking-wide text-slate-400">4 Kategori (slot tetap, hanya bisa diperbarui)</p>
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <?php foreach ($categories ?? [] as $cat): ?>
                        <div class="rounded-xl border border-slate-200 p-4">
                            <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-slate-400">Kategori #<?= esc((string) $cat['id']) ?></p>
                            <label class="mb-1 block text-xs font-semibold text-slate-700">Nama Kategori</label>
                            <input type="text" name="categories[<?= esc((string) $cat['id']) ?>][name]" value="<?= esc($cat['name'] ?? '') ?>" class="admin-input mb-3">
                            <label class="mb-1 block text-xs font-semibold text-slate-700">Keterangan</label>
                            <textarea name="categories[<?= esc((string) $cat['id']) ?>][description]" rows="2" class="admin-input mb-3"><?= esc($cat['description'] ?? '') ?></textarea>
                            <label class="mb-1 block text-xs font-semibold text-slate-700">Gambar</label>
                            <?php if (! empty($cat['image'])): ?>
                                <div class="mb-2 overflow-hidden rounded-lg border border-slate-200">
                                    <img src="<?= base_url($cat['image']) ?>" class="h-20 w-full object-cover">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="category_<?= esc((string) $cat['id']) ?>_image_file" accept="image/jpeg,image/png,image/webp" class="admin-input text-xs">
                        </div>
                    <?php endforeach; ?>

                    <?php if (empty($categories)): ?>
                        <p class="text-sm text-slate-400">Belum ada data kategori di database.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-6">
                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.1em] text-red-700">Section 5 — Galeri Instagram</p>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Judul Section</label>
                        <input type="text" name="home[igHeading]" value="<?= esc($home['igHeading'] ?? 'Ikuti Kami di Instagram!') ?>" class="admin-input">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Nama/Username IG</label>
                        <input type="text" name="home[igHandle]" value="<?= esc($home['igHandle'] ?? '@pga.id') ?>" placeholder="@pga.id" class="admin-input">
                        <p class="mt-1 text-xs text-slate-400">Tombol nama IG ini tetap memakai Instagram URL di tab Profil Perusahaan.</p>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Keterangan</label>
                        <input type="text" name="home[igCaption]" value="<?= esc($home['igCaption'] ?? 'Kreasikan momen baking favoritmu dan jadikan inspirasimu bersinar bersama PGA.') ?>" class="admin-input">
                    </div>
                </div>

                <p class="mt-5 mb-3 text-xs font-semibold uppercase tracking-wide text-slate-400">6 Gambar Galeri (slot tetap, hanya bisa diperbarui)</p>
                <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-6">
                    <?php for ($i = 1; $i <= 6; $i++): ?>
                        <div class="rounded-xl border border-slate-200 p-3">
                            <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-400">Slot <?= $i ?></p>
                            <?php if (! empty($home["igImage{$i}"])): ?>
                                <div class="mb-2 overflow-hidden rounded-lg border border-slate-200">
                                    <img src="<?= base_url($home["igImage{$i}"]) ?>" class="h-20 w-full object-cover">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="home_ig_image<?= $i ?>_file" accept="image/jpeg,image/png,image/webp" class="admin-input text-xs mb-2">
                            <label class="mb-1 block text-[11px] font-semibold text-slate-500">URL Postingan IG</label>
                            <input type="text" name="home[igUrl<?= $i ?>]" value="<?= esc($home["igUrl{$i}"] ?? '') ?>" placeholder="https://instagram.com/p/..." class="admin-input text-xs">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <button type="submit" class="admin-btn-primary">Simpan Setting</button>
        </div>
    </form>
</div>

<script>
(function() {
    document.querySelectorAll('#settingTabs .tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('#settingTabs .tab-btn').forEach(b => b.classList.remove('bg-white', 'text-red-700', 'shadow-sm'));
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
            btn.classList.add('bg-white', 'text-red-700', 'shadow-sm');
            document.querySelector(`[data-tab-panel="${btn.dataset.tab}"]`).classList.remove('hidden');
        });
    });

    const setupPhotoPicker = (btnId, inputId, imgId, iconId) => {
        const btn   = document.getElementById(btnId);
        const input = document.getElementById(inputId);
        const img   = document.getElementById(imgId);
        const icon  = document.getElementById(iconId);
        if (!btn || !input || !img) return;

        btn.addEventListener('click', () => input.click());
        input.addEventListener('change', () => {
            const file = input.files && input.files[0];
            if (!file) return;
            img.src = URL.createObjectURL(file);
            img.classList.remove('hidden');
            if (icon) icon.classList.add('hidden');
        });
    };

    setupPhotoPicker('logoChangeBtn', 'logoFileInput', 'logoPreviewImg', 'logoPlaceholderIcon');
    setupPhotoPicker('companyPhotoChangeBtn', 'companyPhotoFileInput', 'companyPhotoPreviewImg', 'companyPhotoPlaceholderIcon');
})();
</script>
<?= $this->endSection() ?>
