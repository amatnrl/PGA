<?php

namespace App\Controllers\Admin;

use App\Models\ArticleModel;

class ArticleController extends ContentCrudController
{
    protected string $redirectUrl = 'admin/articles';
    protected string $moduleTitle = 'Article';
    protected string $auditModel  = 'Article';

    public function __construct()
    {
        $this->model = new ArticleModel();
    }
}
