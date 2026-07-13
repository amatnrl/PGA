<?php

namespace App\Controllers\Site;

use App\Services\DistributionMapService;
use App\Services\SettingService;

class About extends SiteBaseController
{
    public function index()
    {
        $settings = new SettingService();
        $site     = $settings->getSite();

        $this->data['title']     = 'Tentang Kami';
        $this->data['seo']       = ['title' => 'Tentang Kami', 'description' => $site['tagline'] ?? ''];
        $this->data['site']      = $site;
        $this->data['about']     = $settings->getAbout();
        $this->data['clusters']  = (new DistributionMapService())->clusters();

        return view('site/about/index', $this->data);
    }
}
