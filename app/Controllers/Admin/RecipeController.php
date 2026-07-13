<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\RecipeModel;

class RecipeController extends ContentCrudController
{
    protected string $redirectUrl = 'admin/recipes';
    protected string $moduleTitle = 'Recipe';
    protected string $auditModel  = 'Recipe';

    public function __construct()
    {
        $this->model = new RecipeModel();
    }

    protected function collectInput(): array
    {
        $data              = parent::collectInput();
        $data['video_url'] = $this->extractVideoUrl((string) $this->request->getPost('video_url'));

        return $data;
    }

    /**
     * Admins sometimes paste a full embed snippet (e.g. Instagram's
     * <blockquote>...) instead of the plain link. Pull just the URL out of
     * it so the field never ends up holding hundreds of characters of markup.
     */
    private function extractVideoUrl(string $raw): string
    {
        $raw = trim($raw);
        if ($raw === '' || ! str_contains($raw, '<')) {
            return mb_substr($raw, 0, 500);
        }

        if (preg_match('/data-instgrm-permalink="([^"]+)"/', $raw, $m)) {
            return mb_substr(html_entity_decode($m[1]), 0, 500);
        }

        if (preg_match('/href="(https?:\/\/[^"]+)"/', $raw, $m)) {
            return mb_substr(html_entity_decode($m[1]), 0, 500);
        }

        return mb_substr(strip_tags($raw), 0, 500);
    }

    protected function extraFormData(?array $item): array
    {
        return [
            'allProducts'        => (new ProductModel())->where('status', 'active')->orderBy('name', 'asc')->findAll(),
            'selectedProductIds' => $item !== null ? (new RecipeModel())->linkedProductIds((int) $item['id']) : [],
        ];
    }

    protected function afterSave(int $id, bool $isNew): void
    {
        (new RecipeModel())->syncProducts($id, $this->request->getPost('products') ?? []);
    }
}
