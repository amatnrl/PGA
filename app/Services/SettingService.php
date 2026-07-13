<?php

namespace App\Services;

class SettingService
{
    private const SITE_KEYS = [
        'companyName', 'tagline', 'logo', 'companyPhoto', 'email', 'phone', 'whatsapp', 'address',
        'instagramUrl', 'facebookUrl', 'tiktokUrl', 'shopeeUrl', 'tokopediaUrl',
    ];

    private const SEO_KEYS = [
        'defaultMetaTitle', 'defaultMetaDescription', 'googleAnalyticsId', 'metaPixelId',
    ];

    private const ABOUT_KEYS = [
        'history', 'vision', 'missionList', 'coreValueIntro',
    ];

    private const HOME_KEYS = [
        // Section 2: Profil Perusahaan (keterangan 1, keterangan 2, gambar)
        'profileDesc1', 'profileDesc2', 'profileImage',
        // Section 3: Keunggulan (3 isian: nama, keterangan, gambar)
        'whyHeading', 'whySubheading',
        'feature1Name', 'feature1Desc', 'feature1Image',
        'feature2Name', 'feature2Desc', 'feature2Image',
        'feature3Name', 'feature3Desc', 'feature3Image',
        // Section headings/subheadings
        'categoriesHeading',
        'featuredHeading', 'featuredSubheading',
        'exploreHeading', 'exploreSubheading',
        'partnerHeading', 'testimonialHeading', 'testimonialSubheading',
        // Instagram gallery section (6 fixed image slots, name + caption)
        'igHeading', 'igHandle', 'igCaption',
        'igImage1', 'igImage2', 'igImage3', 'igImage4', 'igImage5', 'igImage6',
        'igUrl1', 'igUrl2', 'igUrl3', 'igUrl4', 'igUrl5', 'igUrl6',
        // Visibility flags
        'showOverview', 'showWhy', 'showCategories', 'showFeatured',
        'showExplore', 'showPartner', 'showTestimonial', 'showInstagram',
    ];

    public function getSite(): array
    {
        return $this->getGroup('Site', self::SITE_KEYS);
    }

    public function getSeo(): array
    {
        return $this->getGroup('SEO', self::SEO_KEYS);
    }

    public function getAbout(): array
    {
        return $this->getGroup('About', self::ABOUT_KEYS);
    }

    public function getHome(): array
    {
        return $this->getGroup('Home', self::HOME_KEYS);
    }

    public function saveSite(array $data): void
    {
        $this->saveGroup('Site', self::SITE_KEYS, $data);
    }

    public function saveSeo(array $data): void
    {
        $this->saveGroup('SEO', self::SEO_KEYS, $data);
    }

    public function saveAbout(array $data): void
    {
        $this->saveGroup('About', self::ABOUT_KEYS, $data);
    }

    public function saveHome(array $data): void
    {
        $this->saveGroup('Home', self::HOME_KEYS, $data);
    }

    private function getGroup(string $class, array $keys): array
    {
        $settings = service('settings');
        $values   = [];

        foreach ($keys as $key) {
            $values[$key] = $settings->get($class . '.' . $key);
        }

        return $values;
    }

    private function saveGroup(string $class, array $keys, array $data): void
    {
        $settings = service('settings');

        foreach ($keys as $key) {
            if (array_key_exists($key, $data)) {
                $settings->set($class . '.' . $key, $data[$key]);
            }
        }
    }
}
