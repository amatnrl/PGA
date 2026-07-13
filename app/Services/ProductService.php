<?php

namespace App\Services;

use App\Libraries\ImageProcessor;
use App\Models\ProductImageModel;
use App\Models\ProductMarketplaceLinkModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class ProductService
{
    private ProductModel $productModel;
    private ProductMarketplaceLinkModel $linkModel;
    private ProductImageModel $imageModel;
    private ImageProcessor $imageProcessor;

    public function __construct()
    {
        $this->productModel   = new ProductModel();
        $this->linkModel      = new ProductMarketplaceLinkModel();
        $this->imageModel     = new ProductImageModel();
        $this->imageProcessor = new ImageProcessor();
    }

    /**
     * @param array $productData Fields for the products table.
     * @param array $marketplace ['shopee' => url, 'tokopedia' => url, 'tiktok' => url].
     */
    public function save(array $productData, array $marketplace, ?int $productId = null): int
    {
        $db = \Config\Database::connect();
        $db->transStart();

        if ($productId === null) {
            $productData['slug'] = $this->productModel->generateUniqueSlug($productData['name']);
            $productId           = $this->productModel->insert($productData, true);
        } else {
            if (empty($productData['slug'])) {
                $productData['slug'] = $this->productModel->generateUniqueSlug($productData['name'], $productId);
            }
            $this->productModel->update($productId, $productData);
        }

        $this->linkModel->where('product_id', $productId)->delete();
        foreach (['shopee', 'tokopedia', 'tiktok'] as $platform) {
            if (! empty($marketplace[$platform])) {
                $this->linkModel->insert([
                    'product_id' => $productId,
                    'platform'   => $platform,
                    'url'        => $marketplace[$platform],
                ]);
            }
        }

        $db->transComplete();

        return $productId;
    }

    /**
     * @param string $kind 'product' (foto produk) or 'result' (foto makanan hasil produk).
     */
    public function addImage(int $productId, UploadedFile $file, string $kind = 'product', bool $isPrimary = false): array
    {
        $destDir  = FCPATH . "uploads/products/{$productId}";
        $baseName = bin2hex(random_bytes(8));
        $path     = $this->imageProcessor->toWebpFullRes($file->getTempName(), $destDir, $baseName);

        if ($isPrimary) {
            $this->imageModel->where('product_id', $productId)->where('kind', $kind)->set(['is_primary' => 0])->update();
        }

        $sortOrder = $this->imageModel->where('product_id', $productId)->where('kind', $kind)->countAllResults();

        $id = $this->imageModel->insert([
            'product_id' => $productId,
            'kind'       => $kind,
            'path'       => $path,
            'is_primary' => $isPrimary ? 1 : 0,
            'sort_order' => $sortOrder,
        ], true);

        return $this->imageModel->find($id);
    }

    public function removeImage(int $imageId): bool
    {
        $image = $this->imageModel->find($imageId);

        if ($image === null) {
            return false;
        }

        $this->imageProcessor->delete([$image['path']]);

        return $this->imageModel->delete($imageId);
    }
}
