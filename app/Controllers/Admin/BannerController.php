<?php

namespace App\Controllers\Admin;

use App\Models\BannerModel;

class BannerController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/banners';
    protected string $redirectUrl = 'admin/banners';
    protected string $moduleTitle = 'Banner';
    protected string $auditModel  = 'Banner';
    protected array $searchFields = [];
    protected array $fileFields   = ['image'];

    public function __construct()
    {
        $this->model = new BannerModel();
    }
}
