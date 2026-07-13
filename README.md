<div align="center">
  <img src=".github/assets/logo.webp" alt="Rumah Kelinci — PT. Pancaran Gemilang Abadi" width="160">

  # PGA — Corporate Website & CMS
  ### PT. Pancaran Gemilang Abadi (Rumah Kelinci)
</div>

---

## Tentang Project

Website korporat sekaligus panel admin (CMS) untuk **PT. Pancaran Gemilang Abadi**. Aplikasi ini terdiri dari dua sisi:

- **Website publik** — profil perusahaan, katalog produk, recipe, baking insight, artikel, activity (event/CSR/seminar/workshop/pameran), galeri, partner, testimonial, FAQ, dan halaman kontak.
- **Admin panel (CMS)** — dashboard untuk mengelola seluruh konten di atas, ditambah manajemen user & permission (role-based access control), pengaturan perusahaan, SEO, banner, backup, dan visitor analytics.

## Teknologi yang Digunakan

**Backend**
- [PHP 8.2+](https://www.php.net/)
- [CodeIgniter 4](https://codeigniter.com/) — framework utama
- [CodeIgniter Shield](https://github.com/codeigniter4/shield) — autentikasi & otorisasi (role/permission based)
- MySQL — database (via MySQLi driver)

**Frontend**
- [Vite](https://vitejs.dev/) — build tool & dev server
- [Tailwind CSS](https://tailwindcss.com/) — styling
- [GSAP](https://gsap.com/) & [AOS](https://michalsnik.github.io/aos/) — animasi
- [Swiper](https://swiperjs.com/) — carousel/slider
- [TinyMCE](https://www.tiny.cloud/) — rich text editor (admin CMS)

**Infrastruktur**
- aaPanel — server management panel
- Cloudflare Tunnel — expose aplikasi ke internet tanpa membuka port publik

## Struktur Peran (Role)

Sistem menggunakan satu peran administratif utama:

| Role | Akses |
|---|---|
| `admin` | Akses penuh: seluruh konten, user & permission management, pengaturan, backup, analytics |
| `editor` | Kelola konten (produk, insight, recipe, article, activity) tanpa akses user & pengaturan inti |

## Instalasi & Setup Lokal

### Prasyarat
- PHP >= 8.2 (ekstensi `intl`, `mbstring`, `mysqlnd`)
- Composer
- Node.js & npm
- MySQL

### Langkah

```bash
# 1. Install dependency PHP
composer install

# 2. Install dependency frontend
npm install

# 3. Salin & sesuaikan environment
cp env .env
# atur app.baseURL dan kredensial database.default.* di .env

# 4. Jalankan migrasi database
php spark migrate

# 5. Build asset frontend
npm run build
# atau untuk mode development dengan hot-reload:
npm run dev

# 6. Jalankan development server
php spark serve
```

Buat akun admin pertama:

```bash
php spark shield:user create -e admin@pga.co.id -g admin
```

## Struktur Direktori Penting

```
app/
├── Controllers/
│   ├── Admin/      # Controller CMS (dashboard, produk, konten, user, settings, dll)
│   └── Site/       # Controller website publik
├── Models/
├── Views/
│   ├── admin/      # Tampilan CMS
│   └── site/       # Tampilan website publik
resources/
├── css/            # Sumber Tailwind CSS (admin & site)
└── js/             # Sumber JavaScript (admin & site)
public/
└── build/          # Hasil build asset (Vite)
```

## Deployment

Aplikasi berjalan di server melalui **aaPanel** (Nginx + PHP-FPM + MySQL) dan diekspos ke internet melalui **Cloudflare Tunnel**, tanpa perlu membuka port publik langsung ke server.
