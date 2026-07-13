<?php

namespace App\Controllers\Site;

use App\Models\FaqModel;
use App\Services\SettingService;

class Contact extends SiteBaseController
{
    public function index()
    {
        $settings = new SettingService();
        $site     = $settings->getSite();

        $this->data['title'] = 'Hubungi Kami';
        $this->data['seo']   = ['title' => 'Hubungi Kami'];
        $this->data['site']  = $site;
        $this->data['faqs']  = (new FaqModel())->where('status', 'active')->orderBy('sort_order', 'asc')->findAll();
        $this->data['schemas'] = [];

        $faqItems = $this->data['faqs'];
        if (! empty($faqItems)) {
            $this->data['schemas'][] = schema_json('FAQPage', [
                'mainEntity' => array_map(static fn ($f) => [
                    '@type'          => 'Question',
                    'name'           => $f['question'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['answer']],
                ], $faqItems),
            ]);
        }

        return view('site/contact/index', $this->data);
    }
}
