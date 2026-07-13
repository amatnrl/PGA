<?php

namespace App\Database\Seeds;

use App\Services\SettingService;
use CodeIgniter\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run()
    {
        $service = new SettingService();

        $service->saveSite([
            'companyName'  => 'PT. Pancaran Gemilang Abadi',
            'tagline'      => 'Solusi Bahan Baku Berkualitas untuk Bisnis yang Terus Bertumbuh',
            'email'        => 'kontak.pga@gmail.com',
            'phone'        => '0822 9361 6520',
            'whatsapp'     => '6282293616520',
            'address'      => 'Jl. Kyai H. Agus Salim No.36, Ende, Kec. Wajo, Kota Makassar, Sulawesi Selatan 90174',
            'instagramUrl' => 'https://www.instagram.com/rumahkelinciofficial/',
            'facebookUrl'  => 'https://www.facebook.com/pancaran.ga/',
            'tiktokUrl'    => '',
        ]);

        $service->saveAbout([
            'history' => '<p>PT. Pancaran Gemilang Abadi berdiri sejak tahun 2016. Perusahaan ini berawal mula pada tahun 1989 dengan nama UD Sentral. Seiring waktu berjalan dan perkembangan usaha, UD Sentral bertumbuh menjadi perusahaan terbatas yang dikenal oleh supplier dan konsumen di bidang bahan makanan.</p>'
                . '<p>PT. Pancaran Gemilang Abadi bergerak di bidang distribusi bahan makanan, bahan kue dan bahan pendukung/perasa makanan. Produk highlight yang tidak asing bagi masyarakat adalah tepung tapioka merk Rumah Kelinci. Selain tepung tapioka, kami juga mendistribusikan berbagai macam bahan makanan dan bahan kue lainnya.</p>'
                . '<p>PT. Pancaran Gemilang Abadi telah berhasil menyediakan dan memenuhi kebutuhan masyarakat di bagian bahan makanan di pulau Sulawesi. Kami berjuang untuk memenuhi kebutuhan seluruh warga Indonesia dan memberikan kepuasan kepada semua mitra usaha dan konsumen.</p>',
            'vision'         => 'Menjadi perusahaan industri pangan terdepan dengan mengutamakan kualitas dan kepuasan pelanggan.',
            'missionList'    => "Memanfaatkan inovasi teknologi terdepan untuk proses produksi yang lebih efektif dan efisien sehingga menghasilkan produk terbaik.\nMenerapkan sistematika kerja dengan prinsip-prinsip manajemen yang baik.\nMemenuhi kebutuhan konsumen dengan tingkat higienis dan kualitas terjamin serta harga yang kompetitif di pasaran.\nMenjalin hubungan harmonis dan saling menguntungkan (mutualisme) dengan klien dan konsumen.",
            'coreValueIntro' => 'Nilai-nilai yang menjadi pedoman PT. Pancaran Gemilang Abadi dalam menjalankan usaha dan melayani mitra di seluruh Indonesia.',
        ]);
    }
}
