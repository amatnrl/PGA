<?php

namespace App\Controllers\Site;

use App\Models\ProductModel;
use App\Models\RecipeModel;
use App\Services\SettingService;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProductController extends SiteBaseController
{
    public function index()
    {
        $model  = new ProductModel();
        $type   = $this->request->getGet('type');
        $search = $this->request->getGet('q');

        $builder = $model->where('status', 'active');
        if ($type) {
            $builder->where('type', $type);
        }
        if ($search) {
            $builder->like('name', $search);
        }

        $products = $builder->orderBy('id', 'desc')->paginate(12);

        $images = $model->primaryImagesFor(array_column($products, 'id'));
        foreach ($products as &$product) {
            $product['image'] = $images[$product['id']] ?? null;
        }

        $this->data['title']    = 'Produk';
        $this->data['seo']      = ['title' => 'Produk'];
        $this->data['products'] = $products;
        $this->data['pager']    = $model->pager;
        $this->data['types']    = ProductModel::TYPES;

        return view('site/product/index', $this->data);
    }

    public function show($slug)
    {
        $model   = new ProductModel();
        $product = $model->where('slug', $slug)->where('status', 'active')->first();

        if ($product === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $settings = new SettingService();
        $site     = $settings->getSite();

        $related = $model->where('type', $product['type'])
            ->where('id !=', $product['id'])
            ->where('status', 'active')
            ->orderBy('id', 'desc')
            ->findAll(8);

        $relatedImages = $model->primaryImagesFor(array_column($related, 'id'));
        foreach ($related as &$r) {
            $r['image'] = $relatedImages[$r['id']] ?? null;
        }

        $waMessage = "Halo PGA,\nSaya tertarik dengan produk:\n{$product['name']}\nMohon informasi lebih lanjut.\nTerima kasih.";

        $this->data['title'] = $product['name'];
        $this->data['seo']   = [
            'title'       => $product['name'],
            'description' => strip_tags((string) $product['description']),
        ];
        $this->data['schemas'] = [
            schema_json('Product', [
                'name'        => $product['name'],
                'description' => strip_tags((string) $product['description']),
            ]),
            schema_json('BreadcrumbList', [
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => base_url()],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Product', 'item' => site_url('product')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $product['name']],
                ],
            ]),
        ];
        $this->data['product']        = $product;
        $this->data['typeLabel']      = ProductModel::TYPES[$product['type']] ?? $product['type'];
        $this->data['images']         = $model->images($product['id'], 'product');
        $this->data['resultImages']   = $model->images($product['id'], 'result');
        $this->data['marketplace']    = $model->marketplaceLinks($product['id']);
        $this->data['related']        = $related;
        $this->data['relatedRecipes'] = (new RecipeModel())->recipesForProduct((int) $product['id']);
        $this->data['waLink']         = 'https://wa.me/' . ($site['whatsapp'] ?? '') . '?text=' . rawurlencode($waMessage);

        return view('site/product/show', $this->data);
    }
}
