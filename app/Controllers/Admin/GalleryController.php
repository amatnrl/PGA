<?php

namespace App\Controllers\Admin;

use App\Models\GalleryModel;

class GalleryController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/galleries';
    protected string $redirectUrl = 'admin/galleries';
    protected string $moduleTitle = 'Gallery';
    protected string $auditModel  = 'Gallery';
    protected array $searchFields = ['caption'];

    public function __construct()
    {
        $this->model = new GalleryModel();
    }
}
