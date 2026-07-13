<?php

namespace App\Controllers\Site;

use App\Models\ActivityModel;
use App\Models\ArticleModel;
use App\Models\InsightModel;
use App\Models\ProductModel;
use App\Models\RecipeModel;

class SitemapController extends SiteBaseController
{
    public function index()
    {
        $staticPages = ['', 'about', 'product', 'explore', 'contact'];

        $urls = [];
        foreach ($staticPages as $page) {
            $urls[] = ['loc' => site_url($page), 'changefreq' => 'weekly'];
        }

        $entries = [
            ['model' => new ProductModel(), 'prefix' => 'product', 'statusField' => 'status', 'statusValue' => 'active'],
            ['model' => new InsightModel(), 'prefix' => 'explore/insight', 'statusField' => 'status', 'statusValue' => 'published'],
            ['model' => new RecipeModel(), 'prefix' => 'explore/recipe', 'statusField' => 'status', 'statusValue' => 'published'],
            ['model' => new ArticleModel(), 'prefix' => 'explore/article', 'statusField' => 'status', 'statusValue' => 'published'],
            ['model' => new ActivityModel(), 'prefix' => 'explore/activity', 'statusField' => 'status', 'statusValue' => 'published'],
        ];

        foreach ($entries as $entry) {
            $rows = $entry['model']->where($entry['statusField'], $entry['statusValue'])->findAll();
            foreach ($rows as $row) {
                $slugField = $entry['prefix'] === 'product' ? 'slug' : 'slug';
                $urls[]    = ['loc' => site_url($entry['prefix'] . '/' . $row[$slugField]), 'changefreq' => 'monthly'];
            }
        }

        return $this->response
            ->setContentType('application/xml')
            ->setBody(view('site/sitemap', ['urls' => $urls], ['debug' => false]));
    }
}
