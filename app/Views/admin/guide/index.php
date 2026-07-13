<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php
/**
 * Each entry: title, where it lives (sidebar group + url), what it's for,
 * step-by-step usage, and — most importantly — where the result actually
 * shows up on the public website, so admins don't edit blind.
 */
$sections = [
    'overview' => [
        'label' => 'Overview', 'color' => 'slate',
        'items' => [
            [
                'title' => 'Dashboard', 'url' => 'admin', 'icon' => 'dashboard',
                'desc'  => 'Halaman pertama yang muncul setelah login. Menampilkan ringkasan jumlah Produk, Resep, Insight, Artikel, Activity, dan pesan masuk dalam bentuk kartu statistik.',
                'steps' => ['Cukup dilihat — tidak ada yang perlu diisi di sini.', 'Gunakan sebagai "cek cepat" apakah semua konten sudah lengkap sebelum melihat website langsung.'],
                'live'  => 'Tidak tampil di website — ini murni ruang kerja internal admin.',
            ],
            [
                'title' => 'Visitor Analytics', 'url' => 'admin/analytics', 'icon' => 'chart',
                'desc'  => 'Statistik pengunjung website (jumlah kunjungan, halaman populer, dll), bersifat hanya-baca.',
                'steps' => ['Buka menu ini kapan saja untuk memantau performa website.', 'Tidak ada tombol simpan/edit — datanya otomatis terekam dari aktivitas pengunjung.'],
                'live'  => 'Tidak tampil di website — laporan internal saja.',
            ],
        ],
    ],
    'content' => [
        'label' => 'Content', 'color' => 'red',
        'items' => [
            [
                'title' => 'Product', 'url' => 'admin/products', 'icon' => 'box',
                'desc'  => 'Pusat kelola semua produk: nama, jenis/kategori, satu foto utama, beberapa foto "Hasil Produk", link ke marketplace (Shopee/Tokopedia/dll), dan status unggulan.',
                'steps' => [
                    'Klik "Tambah Produk", isi nama dan pilih jenis produk.',
                    'Unggah 1 foto utama — kalau diunggah foto baru, foto lama otomatis tergantikan (tidak perlu hapus manual).',
                    'Tambahkan beberapa foto "Hasil Produk" sebagai galeri (boleh tambah/hapus satu per satu).',
                    'Isi link marketplace per platform (cukup tempel link toko produk tersebut).',
                    'Di halaman daftar produk, klik ikon bintang untuk menjadikan produk sebagai "Unggulan" tanpa perlu masuk ke form edit.',
                    'Gunakan kolom pencarian + filter jenis di atas tabel untuk menemukan produk dengan cepat.',
                ],
                'live'  => 'Muncul di halaman Produk, halaman Detail Produk, dan di Home pada bagian "Berbagai Macam Jenis Produk Kami" / produk unggulan.',
            ],
            [
                'title' => 'Jalur Distribusi', 'url' => 'admin/branches', 'icon' => 'branch',
                'desc'  => 'Daftar wilayah dan kota/daerah yang dijangkau jalur distribusi PGA. Satu wilayah bisa punya banyak baris data — setiap baris adalah satu kota/daerah tujuan dalam wilayah tersebut.',
                'steps' => [
                    'Isi nama "Wilayah" (contoh: Sulawesi Selatan) — wilayah yang sama akan otomatis mengelompok jadi satu cluster warna di peta.',
                    'Isi "Kota/Daerah Tujuan" untuk satu kota yang dijangkau — ulangi tambah data baru untuk setiap kota lain di wilayah yang sama.',
                    'Gunakan filter Wilayah + kolom pencarian di atas tabel untuk merapikan data yang sudah banyak.',
                    'Set status "Aktif" agar wilayah tersebut tampil di peta — status nonaktif otomatis disembunyikan dari peta tanpa perlu menghapus datanya.',
                ],
                'live'  => 'Tampil sebagai peta choropleth interaktif (Leaflet) "Peta Jalur Distribusi" di halaman About, tepat di bawah section Visi & Misi — setiap provinsi yang terdaftar otomatis diwarnai sesuai wilayahnya, klik area provinsinya (atau pilih dari daftar di samping peta) untuk melihat daftar kota tujuan.',
            ],
            [
                'title' => 'Baking Insight, Recipe, Article, Activity', 'url' => 'admin/insights', 'icon' => 'insight',
                'desc'  => 'Empat menu ini berbagi bentuk form yang sama: Judul, Deskripsi (editor teks kaya/TinyMCE), satu foto utama, status Draft/Published, dan tanggal publish. Slug URL dibuat otomatis dari judul.',
                'steps' => [
                    'Isi judul — jangan lupa, ini juga menentukan URL halaman (slug) secara otomatis.',
                    'Tulis isi konten di editor — gunakan heading, bold, bullet list, gambar, dan tabel seperti di Word, semua format ini akan tampil sama persis di website.',
                    'Unggah foto utama (akan jadi gambar sampul di kartu & halaman detail).',
                    'Set status ke "Published" supaya tampil di website publik — "Draft" hanya tersimpan, tidak tampil ke pengunjung.',
                    'Atur "Tanggal" — dipakai untuk urutan terbaru dan filter Arsip Bulan/Tahun di halaman Explore.',
                ],
                'live'  => 'Muncul di halaman Explore (explore/insight, explore/recipe, explore/article, explore/activity) dan kartu-kartunya di Home (Insight & Resep Terbaru).',
            ],
            [
                'title' => 'Recipe — tambahan khusus', 'url' => 'admin/recipes', 'icon' => 'recipe',
                'desc'  => 'Selain field standar di atas, form Recipe punya 2 fitur tambahan: link video embed dan keterkaitan dengan Produk.',
                'steps' => [
                    'URL Embed Video — tempel link video resepnya (YouTube atau Instagram Reel/Post). Cukup link biasa, bukan kode embed/blockquote — sistem otomatis mengubahnya jadi video yang bisa diputar langsung di halaman detail resep.',
                    'Produk Terkait — centang produk PGA yang dipakai dalam resep ini. Resep ini lalu otomatis muncul sebagai "Resep Terkait" di halaman detail produk yang dicentang.',
                ],
                'live'  => 'Video tampil berdampingan dengan deskripsi di halaman detail resep; centang produk membuat resep tampil di bagian "Resep Terkait" pada halaman produk tersebut.',
            ],
            [
                'title' => 'Banner', 'url' => 'admin/banners', 'icon' => 'banner',
                'desc'  => 'Gambar-gambar slider besar di paling atas halaman depan, lengkap dengan tombol aktif/nonaktif.',
                'steps' => ['Unggah gambar banner (disarankan ukuran landscape lebar).', 'Gunakan toggle status untuk menampilkan/menyembunyikan tanpa harus menghapus datanya.'],
                'live'  => 'Tampil sebagai slider Hero paling atas di halaman Home.',
            ],
            [
                'title' => 'FAQ', 'url' => 'admin/faqs', 'icon' => 'faq',
                'desc'  => 'Pasangan pertanyaan & jawaban yang sering ditanyakan pelanggan.',
                'steps' => ['Isi pertanyaan singkat dan jawaban yang jelas.', 'Gunakan kolom pencarian untuk mengelola FAQ yang sudah banyak.', 'Toggle status untuk sembunyikan FAQ tanpa menghapus.'],
                'live'  => 'Tampil sebagai accordion FAQ di halaman Contact.',
            ],
            [
                'title' => 'Partner', 'url' => 'admin/partners', 'icon' => 'partner',
                'desc'  => 'Logo perusahaan/brand mitra kerja sama.',
                'steps' => ['Unggah logo (disarankan latar transparan agar rapi).', 'Toggle status untuk tampil/sembunyikan.'],
                'live'  => 'Tampil sebagai deretan logo di section "Partner Kami" pada Home.',
            ],
            [
                'title' => 'Testimonial', 'url' => 'admin/testimonials', 'icon' => 'star',
                'desc'  => 'Ulasan/komentar pelanggan, lengkap dengan nama dan foto.',
                'steps' => ['Isi nama, unggah foto, dan tulis kutipan testimoni.', 'Toggle status untuk tampil/sembunyikan dari Home.'],
                'live'  => 'Tampil di section Testimonial pada halaman Home.',
            ],
            [
                'title' => 'Kontak', 'url' => 'admin/messages', 'icon' => 'mail',
                'desc'  => 'Satu form sederhana untuk nomor WhatsApp, email, dan alamat perusahaan — bukan daftar pesan masuk, melainkan data kontak resmi yang ditampilkan ke pengunjung.',
                'steps' => ['Isi/perbarui nomor WhatsApp, email, dan alamat.', 'Klik simpan — perubahan langsung tampil di seluruh website tanpa perlu publish terpisah.'],
                'live'  => 'Tampil di Footer setiap halaman dan di kartu Informasi Kontak pada halaman Contact (tombol Chat WhatsApp memakai nomor ini).',
            ],
        ],
    ],
    'system' => [
        'label' => 'System', 'color' => 'indigo',
        'items' => [
            [
                'title' => 'User Management', 'url' => 'admin/users', 'icon' => 'user',
                'desc'  => 'Kelola akun yang boleh masuk ke admin panel, beserta perannya: Admin atau Editor — masing-masing punya hak akses menu yang berbeda.',
                'steps' => ['Tambah user baru dengan username, email, password, dan pilih perannya (group).', 'Edit/hapus user yang sudah tidak aktif bekerja.', 'Berikan peran "Editor" untuk staf yang hanya boleh mengelola konten, bukan setting inti.'],
                'live'  => 'Tidak tampil di website — murni mengatur siapa yang boleh mengakses admin panel ini.',
            ],
            [
                'title' => 'Backup Management', 'url' => 'admin/backups', 'icon' => 'database',
                'desc'  => 'Cadangkan (backup) seluruh data database kapan saja, unduh hasilnya, atau hapus backup lama.',
                'steps' => ['Klik "Buat Backup" sebelum melakukan perubahan besar (misalnya sebelum import data dalam jumlah banyak).', 'Unduh file backup secara berkala untuk disimpan di tempat aman.', 'Hapus backup lama yang sudah tidak diperlukan agar tidak memenuhi server.'],
                'live'  => 'Tidak tampil di website — ini jaring pengaman data, bukan fitur publik.',
            ],
            [
                'title' => 'Setting — Perusahaan', 'url' => 'admin/settings', 'icon' => 'settings',
                'desc'  => 'Tab pertama di menu Setting. Berisi identitas resmi perusahaan: logo, foto perusahaan, nama, tagline, serta seluruh link media sosial (Instagram/Facebook/TikTok) dan marketplace (Shopee/Tokopedia).',
                'steps' => ['Unggah logo — otomatis dipakai di Navbar, Footer, dan ikon tab browser (favicon) admin panel.', 'Unggah foto perusahaan — dipakai di halaman About.', 'Isi seluruh link sosial media & marketplace — biarkan kosong kalau memang belum punya akun di platform tersebut, tombolnya otomatis tidak tampil.'],
                'live'  => 'Logo & nama tampil di Navbar/Footer seluruh halaman; tombol sosial media & marketplace tampil otomatis di Footer dan halaman Contact.',
            ],
            [
                'title' => 'Setting — About', 'url' => 'admin/settings', 'icon' => 'settings',
                'desc'  => 'Tab kedua. Berisi konten halaman "Tentang Kami": sejarah/profil perusahaan, visi, dan daftar misi.',
                'steps' => ['Tulis sejarah/profil perusahaan di editor teks kaya — ini yang muncul berdampingan dengan foto perusahaan.', 'Isi Visi dalam satu paragraf singkat.', 'Isi Misi satu poin per baris (tekan Enter untuk poin baru) — setiap baris otomatis jadi satu daftar bercentang di halaman.'],
                'live'  => 'Tampil sepenuhnya di halaman About: foto + profil perusahaan, lalu section Visi & Misi.',
            ],
            [
                'title' => 'Setting — Homepage', 'url' => 'admin/settings', 'icon' => 'settings',
                'desc'  => 'Tab ketiga, paling panjang — mengatur isi tiap section di halaman Home satu per satu: Profil singkat, "Kenapa Memilih Kami" (3 keunggulan), judul-judul section, dan galeri Instagram (6 slot foto + link masing-masing).',
                'steps' => [
                    'Isi heading/subheading tiap section sesuai label yang tertulis di atas kolomnya (urutannya sama dengan urutan tampil di Home).',
                    'Untuk 3 kartu "Keunggulan", isi nama+keterangan+gambar satu per satu.',
                    'Untuk galeri Instagram, unggah gambar di 6 slot dan isi link post Instagram masing-masing — saat foto di-hover di website, ikon IG akan langsung membuka link tersebut.',
                ],
                'live'  => 'Setiap kolom punya pasangan langsung di Home — coba buka Home di tab baru sambil mengisi form ini supaya terlihat hasilnya secara langsung.',
            ],
        ],
    ],
];

$badgeColor = [
    'slate'  => 'bg-slate-100 text-slate-600',
    'red'    => 'bg-red-100 text-red-700',
    'indigo' => 'bg-indigo-100 text-indigo-700',
];
?>

<div class="w-full space-y-6">
    <div class="overflow-hidden rounded-3xl border border-red-100 bg-gradient-to-br from-red-50 via-white to-amber-50 p-7 sm:p-9">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full bg-white/80 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-red-700 shadow-sm">
                    <svg viewBox="0 0 24 24" class="h-3.5 w-3.5 fill-current"><path d="M4 4.8c2.6-1.2 5.4-1.1 8 .3v13.1c-2.6-1.3-5.4-1.4-8-.3V4.8Zm16 0v12.8c-2.6-1.1-5.4-1-8 .3V5.1c2.6-1.4 5.4-1.5 8-.3Z"/></svg>
                    Panduan Penggunaan
                </span>
                <h2 class="mt-3 font-semibold text-2xl text-slate-900">Bingung mulai dari mana? Mulai dari sini.</h2>
                <p class="mt-2 max-w-2xl text-sm text-slate-600">Setiap menu di sidebar kiri dijelaskan di halaman ini: fungsinya, cara mengisinya, dan — yang paling penting — <strong>di mana hasilnya muncul di website</strong>. Klik judul tiap menu untuk membuka detailnya.</p>
            </div>
            <div class="hidden shrink-0 sm:block">
                <div class="flex h-20 w-20 items-center justify-center rounded-3xl bg-white shadow-sm ring-1 ring-red-100">
                    <svg viewBox="0 0 24 24" class="h-9 w-9 fill-red-600"><path d="M4 4.8c2.6-1.2 5.4-1.1 8 .3v13.1c-2.6-1.3-5.4-1.4-8-.3V4.8Zm16 0v12.8c-2.6-1.1-5.4-1-8 .3V5.1c2.6-1.4 5.4-1.5 8-.3Z"/></svg>
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-2">
            <?php foreach ($sections as $key => $group): ?>
                <a href="#guide-<?= esc($key) ?>" class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3.5 py-1.5 text-xs font-semibold text-slate-600 transition hover:border-red-300 hover:text-red-700">
                    <span class="h-1.5 w-1.5 rounded-full <?= $badgeColor[$group['color']] === 'bg-slate-100 text-slate-600' ? 'bg-slate-400' : ($group['color'] === 'red' ? 'bg-red-500' : 'bg-indigo-500') ?>"></span>
                    <?= esc($group['label']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php foreach ($sections as $key => $group): ?>
        <div id="guide-<?= esc($key) ?>" class="space-y-3">
            <div class="flex items-center gap-2.5 px-1">
                <span class="admin-badge <?= $badgeColor[$group['color']] ?>"><?= esc($group['label']) ?></span>
                <span class="text-xs text-slate-400"><?= count($group['items']) ?> menu</span>
            </div>

            <div class="space-y-3">
                <?php foreach ($group['items'] as $i => $item): ?>
                    <details class="admin-card group overflow-hidden p-0" <?= $i === 0 ? 'open' : '' ?>>
                        <summary class="flex cursor-pointer list-none items-center gap-4 px-5 py-4 select-none">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl <?= $badgeColor[$group['color']] ?>">
                                <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><?php
                                    $icons = [
                                        'dashboard' => '<path d="M3 13.2h8.2V3H3v10.2Zm0 7.8h8.2v-5.8H3V21Zm10.8 0H22V10.8h-8.2V21Zm0-17.8v5.6H22V3.2h-8.2Z"/>',
                                        'chart'     => '<path d="M4 20.5h16v-2.2H4v2.2Zm1.8-4.8h2.5V9.1H5.8v6.6Zm4.9 0h2.5V5.8h-2.5v9.9Zm4.9 0h2.5V11h-2.5v4.7Z"/>',
                                        'box'       => '<path d="m12 2.8 8.5 4.4v9.6L12 21.2 3.5 16.8V7.2L12 2.8Zm0 2.5-5.8 3 5.8 3 5.8-3-5.8-3Zm-6 5.1v5l5 2.6v-5l-5-2.6Zm7.4 7.6 5-2.6v-5l-5 2.6v5Z"/>',
                                        'branch'    => '<path d="M6 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM18 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM12 15a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM7 7.8l3.8 6.4-1.9 1.1L5.1 9 7 7.8Zm10 0L18.9 9l-3.8 6.3-1.9-1.1L17 7.8Z"/>',
                                        'insight'   => '<path d="M11 3h2v8h-2V3Zm0 10h2v2h-2v-2Zm1 8.5A8.5 8.5 0 1 1 12 4a8.5 8.5 0 0 1 0 17.5Zm0-2.3a6.2 6.2 0 1 0 0-12.4 6.2 6.2 0 0 0 0 12.4Z"/>',
                                        'recipe'    => '<path d="M6 3h12v18H6V3Zm2.2 2.2v13.6h7.6V5.2H8.2Zm1.3 2.1h5v2h-5v-2Zm0 3.6h5v2h-5v-2Z"/>',
                                        'banner'    => '<path d="M4 5h16v10H8l-4 4V5Zm2.2 2.2v6.6h11.6V7.2H6.2Z"/>',
                                        'faq'       => '<path d="M12 2.8a9.2 9.2 0 1 1 0 18.4A9.2 9.2 0 0 1 12 2.8Zm0 2.2a7 7 0 1 0 0 14 7 7 0 0 0 0-14Zm-1.2 9.8h2.4v2.3h-2.4v-2.3Zm0-7h2.4c1.9 0 3.2 1.2 3.2 3 0 1.4-.8 2.3-1.9 2.9-.7.4-1.1.7-1.1 1.4v.4h-2.2v-.7c0-1.7.8-2.6 2-3.3.7-.4 1-.7 1-1.1 0-.6-.4-1-1.1-1h-2.3V7.8Z"/>',
                                        'partner'   => '<path d="M7.2 5.2A3.2 3.2 0 1 1 7.2 11.6 3.2 3.2 0 0 1 7.2 5.2Zm9.6 0A3.2 3.2 0 1 1 16.8 11.6 3.2 3.2 0 0 1 16.8 5.2ZM4 18.2c0-2.1 1.7-3.8 3.8-3.8h2.4c2.1 0 3.8 1.7 3.8 3.8V20H4v-1.8Zm10 0c0-2.1 1.7-3.8 3.8-3.8h.2c2.1 0 3.8 1.7 3.8 3.8V20H14v-1.8Z"/>',
                                        'star'      => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1 6.2L12 17.3l-5.5 2.9 1-6.2L3 9.6l6.2-.9L12 3Z"/>',
                                        'mail'      => '<path d="M3 5h18v14H3V5Zm2.2 2.2v.4l6.8 4.8 6.8-4.8v-.4H5.2Zm13.6 9.6V10l-6.1 4.3a1.2 1.2 0 0 1-1.4 0L5.2 10v6.8h13.6Z"/>',
                                        'user'      => '<path d="M12 3.5a4.3 4.3 0 1 1 0 8.6 4.3 4.3 0 0 1 0-8.6Zm0 10.8c4.2 0 7.6 2.4 7.6 5.4V21H4.4v-1.3c0-3 3.4-5.4 7.6-5.4Z"/>',
                                        'database'  => '<path d="M12 3c4.7 0 8 1.7 8 4v10c0 2.3-3.3 4-8 4s-8-1.7-8-4V7c0-2.3 3.3-4 8-4Zm0 2.3c-3.6 0-5.8 1.1-5.8 1.7S8.4 8.7 12 8.7 17.8 7.6 17.8 7 15.6 5.3 12 5.3Zm0 6c-3.1 0-5.4-.8-6.8-1.9V11c0 .6 2.2 1.7 6.8 1.7s6.8-1.1 6.8-1.7V9.4c-1.4 1.1-3.7 1.9-6.8 1.9Zm0 5.7c-3.1 0-5.4-.8-6.8-1.9V17c0 .6 2.2 1.7 6.8 1.7s6.8-1.1 6.8-1.7v-1.9c-1.4 1.1-3.7 1.9-6.8 1.9Z"/>',
                                        'settings'  => '<path d="m19.4 13.3 1.6-1.2-1.6-2.8-2 .4a6.4 6.4 0 0 0-1.1-.7l-.3-2h-3.2l-.3 2c-.4.2-.8.4-1.2.7l-2-.4L3.7 12l1.6 1.3c0 .4 0 .8.1 1.1l-1.7 1.3 1.6 2.8 2-.4c.4.3.8.5 1.2.7l.3 2h3.2l.3-2c.4-.2.8-.4 1.2-.7l2 .4 1.6-2.8-1.6-1.2c.1-.4.1-.8.1-1.2ZM12 15.6a3.4 3.4 0 1 1 0-6.8 3.4 3.4 0 0 1 0 6.8Z"/>',
                                    ];
                                    echo $icons[$item['icon']] ?? '<circle cx="12" cy="12" r="8"/>';
                                ?></svg>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block truncate text-sm font-semibold text-slate-900"><?= esc($item['title']) ?></span>
                                <span class="block truncate text-xs text-slate-400"><?= esc($item['desc']) ?></span>
                            </span>
                            <a href="<?= site_url($item['url']) ?>" class="hidden shrink-0 items-center gap-1 rounded-full border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-500 transition hover:border-red-300 hover:text-red-700 sm:inline-flex" onclick="event.stopPropagation()">
                                Buka menu
                                <svg viewBox="0 0 24 24" class="h-3 w-3 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                            </a>
                            <svg viewBox="0 0 24 24" class="h-4 w-4 shrink-0 fill-current text-slate-400 transition-transform duration-300 group-open:rotate-180"><path d="M6 9l6 6 6-6"/></svg>
                        </summary>

                        <div class="border-t border-slate-100 bg-slate-50/60 px-5 py-5">
                            <p class="text-sm leading-relaxed text-slate-600"><?= esc($item['desc']) ?></p>

                            <div class="mt-4">
                                <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">Cara Pakai</p>
                                <ol class="space-y-2">
                                    <?php foreach ($item['steps'] as $n => $step): ?>
                                        <li class="flex gap-2.5 text-sm text-slate-700">
                                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-red-100 text-[11px] font-bold text-red-700"><?= $n + 1 ?></span>
                                            <span class="leading-relaxed"><?= esc($step) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>

                            <div class="mt-4 flex items-start gap-2.5 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3">
                                <svg viewBox="0 0 24 24" class="mt-0.5 h-4 w-4 shrink-0 fill-amber-600"><path d="M12 2.5 2 20.5h20L12 2.5Zm0 6 1.2 7h-2.4l1.2-7ZM11 18.2h2v2h-2v-2Z"/></svg>
                                <p class="text-xs leading-relaxed text-amber-800"><strong class="font-semibold">Tampil di website:</strong> <?= esc($item['live']) ?></p>
                            </div>

                            <a href="<?= site_url($item['url']) ?>" class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold text-red-700 hover:underline sm:hidden">
                                Buka menu <?= esc($item['title']) ?>
                                <svg viewBox="0 0 24 24" class="h-3 w-3 fill-current"><path d="M5 12h12m-5-6 6 6-6 6"/></svg>
                            </a>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
