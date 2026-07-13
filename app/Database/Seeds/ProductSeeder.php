<?php

namespace App\Database\Seeds;

use App\Libraries\ImageProcessor;
use App\Libraries\PlaceholderImageGenerator;
use App\Models\ProductImageModel;
use App\Services\ProductService;
use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    private const NAMES = [
        'bahan_makanan' => [
            'Tepung Tapioka Rumah Kelinci', 'Tepung Premix Serbaguna', 'Cokelat Compound Premium',
            'Cokelat Couverture', 'Keju Bubuk', 'Margarin Premium', 'Pengembang Kue', 'Pewarna Makanan Food Grade',
        ],
        'bahan_minuman' => [
            'Bubuk Cokelat Premium', 'Bubuk Matcha', 'Bubuk Taro', 'Bubuk Red Velvet',
            'Bubuk Thai Tea', 'Syrup Premium', 'Creamer Premium', 'Gula Cair',
        ],
        'kerupuk' => [
            'Kerupuk Udang Premium', 'Kerupuk Ikan', 'Kerupuk Bawang', 'Kerupuk Kulit',
            'Kerupuk Palembang', 'Keripik Singkong',
        ],
        'lainnya' => [
            'Kemasan Produk Food Grade', 'Cup Minuman', 'Sedotan Ramah Lingkungan', 'Alat Baking',
        ],
    ];

    public function run()
    {
        helper('text');

        $productService = new ProductService();
        $imageGenerator = new PlaceholderImageGenerator();
        $imageProcessor = new ImageProcessor();
        $imageModel     = new ProductImageModel();

        $count = 0;

        foreach (self::NAMES as $type => $names) {
            foreach ($names as $name) {
                $count++;

                $productData = [
                    'type'        => $type,
                    'name'        => $name,
                    'description' => "<p>{$name} adalah produk unggulan PT. Pancaran Gemilang Abadi, diproduksi dengan standar kualitas tinggi dan higienis, cocok untuk kebutuhan bisnis F&B Anda.</p>",
                    'status'      => 'active',
                ];

                $marketplace = [
                    'shopee'    => $count % 2 === 0 ? 'https://shopee.co.id/pga-' . url_title(strtolower($name), '-', true) : '',
                    'tokopedia' => $count % 3 === 0 ? 'https://tokopedia.com/pga-' . url_title(strtolower($name), '-', true) : '',
                    'tiktok'    => $count % 5 === 0 ? 'https://tiktokshop.com/pga-' . url_title(strtolower($name), '-', true) : '',
                ];

                $productId = $productService->save($productData, $marketplace);

                // Foto produk (kemasan/bahan baku) — satu foto utama.
                $tempPath = $imageGenerator->generate($name);
                $sizes    = $imageProcessor->process($tempPath, FCPATH . "uploads/products/{$productId}", bin2hex(random_bytes(8)));
                @unlink($tempPath);

                $imageModel->insert([
                    'product_id' => $productId,
                    'kind'       => 'product',
                    'path'       => $sizes['medium'],
                    'is_primary' => 1,
                    'sort_order' => 0,
                ]);

                // Foto hasil produk — contoh makanan/minuman jadi dari bahan ini.
                $resultLabel = $name . ' - Hasil Olahan';
                $tempPath2   = $imageGenerator->generate($resultLabel);
                $sizes2      = $imageProcessor->process($tempPath2, FCPATH . "uploads/products/{$productId}", bin2hex(random_bytes(8)));
                @unlink($tempPath2);

                $imageModel->insert([
                    'product_id' => $productId,
                    'kind'       => 'result',
                    'path'       => $sizes2['medium'],
                    'is_primary' => 0,
                    'sort_order' => 0,
                ]);
            }
        }

        echo "Seeded {$count} products.\n";
    }
}
