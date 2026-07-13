<?php

namespace App\Controllers\Admin;

use App\Libraries\ImageProcessor;
use App\Models\HomeCategoryModel;
use App\Services\AuditService;
use App\Services\SettingService;

class SettingController extends AdminBaseController
{
    private SettingService $service;

    public function __construct()
    {
        $this->service = new SettingService();
    }

    public function index()
    {
        $this->data['title']      = 'Setting';
        $this->data['site']       = $this->service->getSite();
        $this->data['about']      = $this->service->getAbout();
        $this->data['home']       = $this->service->getHome();
        $this->data['categories'] = (new HomeCategoryModel())->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->findAll(4);

        return view('admin/settings/index', $this->data);
    }

    public function update()
    {
        $site       = $this->request->getPost('site') ?? [];
        $about      = $this->request->getPost('about') ?? [];
        $home       = $this->request->getPost('home') ?? [];
        $categories = $this->request->getPost('categories') ?? [];

        $oldSite = $this->service->getSite();
        $oldHome = $this->service->getHome();

        $this->applyImageUpload($site, $oldSite, 'logo', 'site_logo_file', 'company');
        $this->applyImageUpload($site, $oldSite, 'companyPhoto', 'site_company_photo_file', 'company');
        $this->applyImageUpload($home, $oldHome, 'profileImage', 'home_profile_image_file', 'home');
        $this->applyImageUpload($home, $oldHome, 'feature1Image', 'home_feature1_image_file', 'home');
        $this->applyImageUpload($home, $oldHome, 'feature2Image', 'home_feature2_image_file', 'home');
        $this->applyImageUpload($home, $oldHome, 'feature3Image', 'home_feature3_image_file', 'home');
        for ($i = 1; $i <= 6; $i++) {
            $this->applyImageUpload($home, $oldHome, "igImage{$i}", "home_ig_image{$i}_file", 'home');
        }

        $this->service->saveSite($site);
        $this->service->saveAbout($about);
        $this->service->saveHome($home);
        $this->saveCategories($categories);

        (new AuditService())->log('update', 'Setting', null, null, ['site' => $site, 'about' => $about, 'home' => $home]);

        return redirect()->to('admin/settings')->with('message', 'Setting berhasil disimpan.');
    }

    /**
     * Updates the 4 fixed home-category rows in place (image/name/description).
     * Rows are never created or deleted here — only their content changes.
     */
    private function saveCategories(array $categories): void
    {
        if ($categories === []) {
            return;
        }

        $model = new HomeCategoryModel();

        foreach ($categories as $id => $fields) {
            $id  = (int) $id;
            $old = $model->find($id);
            if ($old === null) {
                continue;
            }

            $data = [
                'name'        => $fields['name'] ?? $old['name'],
                'description' => $fields['description'] ?? $old['description'],
            ];

            $file = $this->request->getFile("category_{$id}_image_file");
            if ($file !== null && $file->isValid()) {
                $destDir  = FCPATH . 'uploads/home';
                $baseName = bin2hex(random_bytes(8));
                $path     = (new ImageProcessor())->toWebpFullRes($file->getTempName(), $destDir, $baseName);

                if (! empty($old['image'])) {
                    (new ImageProcessor())->delete([$old['image']]);
                }

                $data['image'] = $path;
            }

            $model->update($id, $data);
        }
    }

    private function applyImageUpload(array &$group, array $old, string $key, string $fileField, string $folder): void
    {
        $file = $this->request->getFile($fileField);
        if ($file === null || ! $file->isValid()) {
            return;
        }

        $destDir  = FCPATH . 'uploads/' . $folder;
        $baseName = bin2hex(random_bytes(8));
        $path     = (new ImageProcessor())->toWebpFullRes($file->getTempName(), $destDir, $baseName);

        if (! empty($old[$key])) {
            (new ImageProcessor())->delete([$old[$key]]);
        }

        $group[$key] = $path;
    }
}
