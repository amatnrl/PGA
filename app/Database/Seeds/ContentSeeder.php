<?php

namespace App\Database\Seeds;

use App\Libraries\ImageProcessor;
use App\Libraries\PlaceholderImageGenerator;
use App\Models\ActivityModel;
use App\Models\ArticleModel;
use App\Models\InsightModel;
use App\Models\RecipeModel;
use CodeIgniter\Database\Seeder;

class ContentSeeder extends Seeder
{
    private ImageProcessor $imageProcessor;
    private PlaceholderImageGenerator $imageGenerator;

    public function run()
    {
        $this->imageProcessor = new ImageProcessor();
        $this->imageGenerator = new PlaceholderImageGenerator();

        $this->seedInsights();
        $this->seedRecipes();
        $this->seedArticles();
        $this->seedActivities();
    }

    private function featuredImage(string $label, string $folder): string
    {
        $tempPath = $this->imageGenerator->generate($label);
        $path     = $this->imageProcessor->toWebpFullRes($tempPath, FCPATH . "uploads/{$folder}", bin2hex(random_bytes(8)));
        @unlink($tempPath);

        return $path;
    }

    private function seedInsights(): void
    {
        $model = new InsightModel();

        $titles = [
            'Cara Memilih Bubuk Cokelat Berkualitas', '5 Tips Menyimpan Bahan Baking Agar Tahan Lama',
            'Perbedaan Cokelat Compound dan Couverture', 'Mengenal Jenis-Jenis Tepung untuk Bakery',
            'Tren Minuman Kekinian 2026', 'Cara Membuat Topping Minuman yang Konsisten',
            'Pentingnya Food Grade Packaging untuk Bisnis F&B', 'Tips Menentukan Supplier Bahan Baku Terpercaya',
            'Mengenal Standar Higienitas Produksi Makanan', 'Strategi Hemat Bahan Baku untuk UMKM F&B',
        ];

        foreach ($titles as $i => $title) {
            $model->insert([
                'title'          => $title,
                'slug'           => $model->generateUniqueSlug($title),
                'content'        => "<p>{$title} &mdash; berikut adalah pembahasan lengkapnya dari tim PGA.</p>",
                'updated_by'     => 'Admin',
                'status'         => 'published',
                'published_at'   => date('Y-m-d', strtotime('-' . $i . ' days')),
                'featured_image' => $this->featuredImage($title, 'insights'),
            ]);
        }
    }

    private function seedRecipes(): void
    {
        $model = new RecipeModel();

        $titles = [
            'Es Cokelat Kekinian', 'Matcha Latte Creamy', 'Taro Milk Tea Premium',
            'Red Velvet Cake Lembut', 'Cappuccino Dingin Spesial', 'Thai Tea Original',
            'Roti Cokelat Lembut', 'Kue Kering Margarin Premium', 'Donat Glaze Manis',
            'Brownies Cokelat Fudgy',
        ];

        foreach ($titles as $i => $title) {
            $model->insert([
                'title'          => $title,
                'slug'           => $model->generateUniqueSlug($title),
                'content'        => "<p>Resep {$title} mudah dengan bahan baku PGA. Campurkan semua bahan, sajikan dengan cara terbaik.</p>",
                'updated_by'     => 'Admin',
                'status'         => 'published',
                'published_at'   => date('Y-m-d', strtotime('-' . $i . ' days')),
                'featured_image' => $this->featuredImage($title, 'recipes'),
            ]);
        }
    }

    private function seedArticles(): void
    {
        $model = new ArticleModel();

        $titles = [
            'Tren Industri F&B 2026', 'PGA Perluas Distribusi ke Wilayah Timur Indonesia',
            'Pentingnya Sertifikasi Halal untuk Produk Makanan', 'Inovasi Kemasan Ramah Lingkungan',
            'Strategi Bisnis Kuliner di Era Digital', 'PGA Raih Penghargaan Distributor Terbaik',
            'Tips Membangun Bisnis Minuman Kekinian', 'Mengenal Rantai Pasok Bahan Baku F&B',
            'Peran Teknologi dalam Industri Makanan', 'PGA Berkomitmen pada Kualitas Berkelanjutan',
        ];

        foreach ($titles as $i => $title) {
            $model->insert([
                'title'          => $title,
                'slug'           => $model->generateUniqueSlug($title),
                'content'        => "<p>{$title} &mdash; simak ulasan lengkap dari PGA.</p>",
                'updated_by'     => 'Admin',
                'status'         => 'published',
                'published_at'   => date('Y-m-d', strtotime('-' . $i . ' days')),
                'featured_image' => $this->featuredImage($title, 'articles'),
            ]);
        }
    }

    private function seedActivities(): void
    {
        $model = new ActivityModel();

        $titles = [
            'Seminar Inovasi Bahan Baku 2026', 'CSR PGA Berbagi untuk Sesama',
            'Workshop Baking Bersama Chef Profesional', 'Pameran Produk PGA di Jakarta Food Expo',
            'Gathering Mitra Distributor PGA', 'Seminar Tren F&B Nasional',
            'CSR Donasi Bahan Pangan ke Panti Asuhan', 'Workshop Racikan Minuman Kekinian',
            'Pameran PGA di Surabaya Culinary Fest', 'Event Anniversary PT. Pancaran Gemilang Abadi',
        ];

        foreach ($titles as $i => $title) {
            $model->insert([
                'title'          => $title,
                'slug'           => $model->generateUniqueSlug($title),
                'content'        => "<p>{$title} &mdash; berikut dokumentasi lengkap kegiatannya.</p>",
                'updated_by'     => 'Admin',
                'status'         => 'published',
                'published_at'   => date('Y-m-d', strtotime('-' . $i . ' months')),
                'featured_image' => $this->featuredImage($title, 'activities'),
            ]);
        }
    }
}
