<?php

namespace App\Models;

class ProductModel extends BaseModel
{
    public const TYPES = [
        'bahan_makanan' => 'Bahan Makanan',
        'bahan_minuman' => 'Bahan Minuman',
        'kerupuk'       => 'Kerupuk',
        'lainnya'       => 'Lainnya',
    ];

    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['type', 'name', 'slug', 'description', 'status', 'is_featured'];
    protected $useTimestamps    = true;

    protected $validationRules = [
        'type'   => 'required|in_list[bahan_makanan,bahan_minuman,kerupuk,lainnya]',
        'name'   => 'required|max_length[200]',
        'status' => 'permit_empty|in_list[active,inactive]',
    ];

    public function images(int $productId, ?string $kind = null)
    {
        $builder = $this->db->table('product_images')->where('product_id', $productId);

        if ($kind !== null) {
            $builder->where('kind', $kind);
        }

        return $builder->orderBy('sort_order', 'asc')->get()->getResultArray();
    }

    public function marketplaceLinks(int $productId)
    {
        return $this->db->table('product_marketplace_links')->where('product_id', $productId)->get()->getResultArray();
    }

    /**
     * Bulk-fetch the primary (or first) product photo for each product ID in one query,
     * avoiding an N+1 query per product on listing pages (Home, Product index, related products).
     *
     * @param list<int> $productIds
     * @return array<int, string|null> product_id => image path
     */
    public function primaryImagesFor(array $productIds): array
    {
        if ($productIds === []) {
            return [];
        }

        $rows = $this->db->table('product_images')
            ->whereIn('product_id', $productIds)
            ->where('kind', 'product')
            ->orderBy('is_primary', 'desc')
            ->orderBy('sort_order', 'asc')
            ->get()
            ->getResultArray();

        $images = [];
        foreach ($rows as $row) {
            $pid = (int) $row['product_id'];
            if (! isset($images[$pid])) {
                $images[$pid] = $row['path'];
            }
        }

        return $images;
    }
}
