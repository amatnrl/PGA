<?php

namespace App\Models;

class RecipeModel extends BaseModel
{
    protected $table          = 'recipes';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'title', 'slug', 'content', 'featured_image', 'updated_by', 'status', 'published_at', 'video_url',
    ];
    protected $useTimestamps  = true;

    protected $validationRules = [
        'title'     => 'required|max_length[220]',
        'status'    => 'permit_empty|in_list[draft,published]',
        'video_url' => 'permit_empty|max_length[500]',
    ];

    /** Product IDs linked to this recipe, e.g. to pre-select checkboxes in the admin form. */
    public function linkedProductIds(int $recipeId): array
    {
        $rows = $this->db->table('recipe_products')
            ->select('product_id')
            ->where('recipe_id', $recipeId)
            ->get()
            ->getResultArray();

        return array_map('intval', array_column($rows, 'product_id'));
    }

    /** Replaces the full set of products linked to this recipe. */
    public function syncProducts(int $recipeId, array $productIds): void
    {
        $this->db->table('recipe_products')->where('recipe_id', $recipeId)->delete();

        $productIds = array_unique(array_filter(array_map('intval', $productIds)));
        if ($productIds === []) {
            return;
        }

        $rows = array_map(static fn ($productId) => ['recipe_id' => $recipeId, 'product_id' => $productId], $productIds);
        $this->db->table('recipe_products')->insertBatch($rows);
    }

    /** Published recipes that use the given product — shown as "Resep Terkait". */
    public function recipesForProduct(int $productId, int $limit = 8): array
    {
        return $this->select('recipes.*')
            ->join('recipe_products', 'recipe_products.recipe_id = recipes.id')
            ->where('recipe_products.product_id', $productId)
            ->where('recipes.status', 'published')
            ->orderBy('recipes.id', 'desc')
            ->findAll($limit);
    }
}
