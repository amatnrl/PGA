<?php

namespace App\Database\Seeds;

use App\Libraries\ImageProcessor;
use App\Libraries\PlaceholderImageGenerator;
use App\Models\BannerModel;
use App\Models\CertificationModel;
use App\Models\CompanyMilestoneModel;
use App\Models\CoreValueModel;
use App\Models\FaqModel;
use App\Models\GalleryModel;
use App\Models\PartnerModel;
use App\Models\TeamMemberModel;
use App\Models\TestimonialModel;
use CodeIgniter\Database\Seeder;

class SupportingDataSeeder extends Seeder
{
    private ImageProcessor $imageProcessor;
    private PlaceholderImageGenerator $imageGenerator;

    public function run()
    {
        $this->imageProcessor = new ImageProcessor();
        $this->imageGenerator = new PlaceholderImageGenerator();

        $this->seedBanners();
        $this->seedPartners();
        $this->seedTestimonials();
        $this->seedFaqs();
        $this->seedCoreValues();
        $this->seedTeamMembers();
        $this->seedCertifications();
        $this->seedMilestones();
        $this->seedGalleries();
    }

    private function image(string $label, string $folder): string
    {
        $tempPath = $this->imageGenerator->generate($label);
        $sizes    = $this->imageProcessor->process($tempPath, FCPATH . "uploads/{$folder}", bin2hex(random_bytes(8)));
        @unlink($tempPath);

        return $sizes['medium'];
    }

    private function seedBanners(): void
    {
        $model = new BannerModel();
        $labels = ['Banner Hero 1', 'Banner Hero 2', 'Banner Hero 3'];

        foreach ($labels as $i => $label) {
            $model->insert([
                'image'      => $this->image($label, 'banners'),
                'sort_order' => $i,
                'status'     => 'active',
            ]);
        }
    }

    private function seedPartners(): void
    {
        $model = new PartnerModel();
        $names = ['Toko Roti Sejahtera', 'Kafe Nusantara', 'Resto Bahagia', 'UMKM Snack Jaya', 'Bakery Modern', 'Distributor Mitra Pangan'];

        foreach ($names as $i => $name) {
            $model->insert([
                'name'       => $name,
                'logo'       => $this->image($name, 'partners'),
                'sort_order' => $i,
                'status'     => 'active',
            ]);
        }
    }

    private function seedTestimonials(): void
    {
        $model = new TestimonialModel();
        $data = [
            ['name' => 'Budi Santoso', 'position' => 'Pemilik Toko Roti', 'content' => 'Bahan baku PGA selalu berkualitas dan pengiriman tepat waktu.'],
            ['name' => 'Siti Aminah', 'position' => 'Pemilik Kafe', 'content' => 'Pelayanan PGA sangat profesional, harga juga kompetitif.'],
            ['name' => 'Andi Wijaya', 'position' => 'Pemilik Resto', 'content' => 'Produk cokelat dari PGA jadi andalan menu kami.'],
            ['name' => 'Rina Sari', 'position' => 'Pelaku UMKM', 'content' => 'Kerupuk PGA renyah dan konsisten kualitasnya.'],
            ['name' => 'Dedi Kurniawan', 'position' => 'Pelanggan Setia', 'content' => 'PGA mitra terpercaya untuk kebutuhan bahan baking kami.'],
        ];

        foreach ($data as $i => $row) {
            $row['photo'] = $this->image($row['name'], 'testimonials');
            $model->insert(array_merge($row, ['rating' => 5, 'sort_order' => $i, 'status' => 'active']));
        }
    }

    private function seedFaqs(): void
    {
        $model = new FaqModel();
        $data = [
            ['question' => 'Apakah PGA menerima pembelian retail?', 'answer' => 'Saat ini PGA fokus melayani pembelian grosir/bisnis, namun beberapa produk juga tersedia di marketplace resmi kami.'],
            ['question' => 'Bagaimana cara melakukan pemesanan?', 'answer' => 'Anda dapat menghubungi kami lewat WhatsApp atau form Contact untuk konsultasi dan pemesanan.'],
            ['question' => 'Apakah produk PGA sudah memiliki sertifikasi halal?', 'answer' => 'Sebagian besar produk PGA telah melalui proses sertifikasi sesuai standar yang berlaku.'],
            ['question' => 'Apakah PGA melayani pengiriman ke luar kota?', 'answer' => 'Ya, PGA melayani pengiriman ke seluruh Indonesia melalui jasa ekspedisi mitra.'],
            ['question' => 'Bagaimana cara menjadi mitra distributor PGA?', 'answer' => 'Silakan hubungi tim kami melalui halaman Contact untuk informasi kemitraan.'],
            ['question' => 'Apakah tersedia sample produk sebelum order besar?', 'answer' => 'Untuk produk tertentu, sample dapat disediakan atas permintaan. Hubungi tim sales kami.'],
        ];

        foreach ($data as $i => $row) {
            $model->insert(array_merge($row, ['sort_order' => $i, 'status' => 'active']));
        }
    }

    private function seedCoreValues(): void
    {
        $model = new CoreValueModel();
        $data = [
            ['icon' => '⭐', 'title' => 'Kualitas Terjamin', 'description' => 'Semua produk PGA melalui quality control yang ketat.'],
            ['icon' => '🤝', 'title' => 'Terpercaya', 'description' => 'Mitra bisnis yang dapat diandalkan sejak awal berdiri.'],
            ['icon' => '🚀', 'title' => 'Inovatif', 'description' => 'Selalu mengikuti tren kebutuhan industri F&B terkini.'],
            ['icon' => '💚', 'title' => 'Berkelanjutan', 'description' => 'Berkomitmen pada praktik bisnis yang bertanggung jawab.'],
        ];

        foreach ($data as $i => $row) {
            $model->insert(array_merge($row, ['sort_order' => $i, 'status' => 'active']));
        }
    }

    private function seedTeamMembers(): void
    {
        $model = new TeamMemberModel();
        $data = [
            ['name' => 'Hendra Wijaya', 'position' => 'Direktur Utama'],
            ['name' => 'Maria Christina', 'position' => 'General Manager'],
            ['name' => 'Agus Setiawan', 'position' => 'Head of Operations'],
            ['name' => 'Lina Marlina', 'position' => 'Head of Sales'],
        ];

        foreach ($data as $i => $row) {
            $model->insert(array_merge($row, [
                'photo'      => $this->image($row['name'], 'team'),
                'sort_order' => $i,
                'status'     => 'active',
            ]));
        }
    }

    private function seedCertifications(): void
    {
        $model = new CertificationModel();
        $data = [
            ['name' => 'Sertifikat Halal MUI', 'type' => 'certification', 'issued_year' => '2022'],
            ['name' => 'ISO 9001:2015', 'type' => 'certification', 'issued_year' => '2023'],
            ['name' => 'Best Distributor Award', 'type' => 'award', 'issued_year' => '2024'],
        ];

        foreach ($data as $i => $row) {
            $model->insert(array_merge($row, [
                'image'      => $this->image($row['name'], 'certifications'),
                'sort_order' => $i,
                'status'     => 'active',
            ]));
        }
    }

    private function seedMilestones(): void
    {
        $model = new CompanyMilestoneModel();
        $data = [
            ['year' => '2010', 'title' => 'Berdirinya PGA', 'description' => 'PT. Pancaran Gemilang Abadi resmi berdiri.'],
            ['year' => '2015', 'title' => 'Ekspansi Gudang', 'description' => 'Membuka gudang distribusi baru untuk menambah kapasitas.'],
            ['year' => '2019', 'title' => 'Sertifikasi Halal', 'description' => 'Memperoleh sertifikasi halal untuk seluruh lini produk.'],
            ['year' => '2023', 'title' => 'Digitalisasi Bisnis', 'description' => 'Meluncurkan platform digital untuk mitra & pelanggan.'],
        ];

        foreach ($data as $i => $row) {
            $model->insert(array_merge($row, ['sort_order' => $i, 'status' => 'active']));
        }
    }

    private function seedGalleries(): void
    {
        $model = new GalleryModel();

        for ($i = 1; $i <= 4; $i++) {
            $model->insert([
                'category'   => 'factory',
                'image'      => $this->image('Gudang PGA ' . $i, 'galleries'),
                'caption'    => 'Gudang Distribusi PGA ' . $i,
                'sort_order' => $i,
                'status'     => 'active',
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            $model->insert([
                'category'   => 'office',
                'image'      => $this->image('Kantor PGA ' . $i, 'galleries'),
                'caption'    => 'Kantor PGA ' . $i,
                'sort_order' => $i,
                'status'     => 'active',
            ]);
        }
    }
}
