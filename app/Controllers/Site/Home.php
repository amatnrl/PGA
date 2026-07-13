<?php

namespace App\Controllers\Site;

use App\Models\BannerModel;
use App\Models\HomeCategoryModel;
use App\Models\InsightModel;
use App\Models\PartnerModel;
use App\Models\ProductModel;
use App\Models\RecipeModel;
use App\Models\TestimonialModel;
use App\Services\SettingService;

class Home extends SiteBaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $settings     = new SettingService();

        $featured = $productModel->where('status', 'active')
            ->where('is_featured', 1)
            ->orderBy('id', 'desc')
            ->findAll(12);

        $images = $productModel->primaryImagesFor(array_column($featured, 'id'));
        foreach ($featured as &$product) {
            $product['image'] = $images[$product['id']] ?? null;
        }

        $insightHighlights = (new InsightModel())->where('status', 'published')->orderBy('id', 'desc')->findAll(10);

        $site = $settings->getSite();

        $this->data['title'] = 'Beranda';
        $this->data['seo']   = [
            'title'       => 'Beranda',
            'description' => $site['tagline'] ?? '',
        ];
        $this->data['schemas'] = [
            schema_json('Organization', [
                'name' => $site['companyName'] ?? 'PT. Pancaran Gemilang Abadi',
                'url'  => base_url(),
            ]),
            schema_json('LocalBusiness', [
                'name'      => $site['companyName'] ?? 'PT. Pancaran Gemilang Abadi',
                'address'   => $site['address'] ?? '',
                'telephone' => $site['phone'] ?? '',
            ]),
        ];
        $this->data['home']               = $settings->getHome();
        $this->data['banners']            = (new BannerModel())->where('status', 'active')->orderBy('sort_order', 'asc')->findAll();
        $this->data['productTypes']       = ProductModel::TYPES;
        $this->data['homeCategories']     = (new HomeCategoryModel())->orderBy('sort_order', 'asc')->findAll(4);
        $this->data['featured']           = $featured;
        $this->data['insightHighlights']  = $insightHighlights;
        $this->data['recentRecipes']      = (new RecipeModel())->where('status', 'published')->orderBy('updated_at', 'desc')->findAll(10);
        $this->data['partners']           = (new PartnerModel())->where('status', 'active')->orderBy('sort_order', 'asc')->findAll();
        $this->data['testimonials']       = (new TestimonialModel())->where('status', 'active')->orderBy('sort_order', 'asc')->findAll();
        $this->data['site']               = $site;
        $this->data['counters']           = [
            'products'     => $productModel->where('status', 'active')->countAllResults(),
            'partners'     => (new PartnerModel())->where('status', 'active')->countAllResults(),
            'testimonials' => (new TestimonialModel())->where('status', 'active')->countAllResults(),
        ];

        return view('site/home/index', $this->data);
    }
}
