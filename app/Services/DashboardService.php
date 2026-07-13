<?php

namespace App\Services;

use App\Models\ActivityModel;
use App\Models\ArticleModel;
use App\Models\BranchModel;
use App\Models\InsightModel;
use App\Models\PartnerModel;
use App\Models\ProductModel;
use App\Models\RecipeModel;

class DashboardService
{
    public function getCounters(): array
    {
        return [
            'products'   => (new ProductModel())->countAllResults(),
            'insights'   => (new InsightModel())->countAllResults(),
            'recipes'    => (new RecipeModel())->countAllResults(),
            'articles'   => (new ArticleModel())->countAllResults(),
            'activities' => (new ActivityModel())->countAllResults(),
            'visitors'   => (new VisitorAnalyticsService())->totalVisitors(),
            'branches'   => (new BranchModel())->countAllResults(),
            'partners'   => (new PartnerModel())->countAllResults(),
        ];
    }
}
