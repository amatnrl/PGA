<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;

abstract class SiteBaseController extends BaseController
{
    protected $helpers = ['form', 'url', 'text', 'seo'];
    protected array $data = [];
}
