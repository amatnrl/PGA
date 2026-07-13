<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Services\AuditService;
use App\Services\ProductService;

class ProductController extends AdminBaseController
{
    private ProductModel $model;
    private ProductService $service;

    public function __construct()
    {
        $this->model   = new ProductModel();
        $this->service = new ProductService();
    }

    public function index()
    {
        $this->data['title'] = 'Product';
        $search               = $this->request->getGet('q');
        $type                 = $this->request->getGet('type');

        $builder = $this->model->orderBy('id', 'desc');
        if ($search) {
            $builder->like('name', $search);
        }
        if ($type) {
            $builder->where('type', $type);
        }

        $items  = $builder->paginate(15);
        $images = $this->model->primaryImagesFor(array_column($items, 'id'));
        foreach ($items as &$item) {
            $item['image'] = $images[$item['id']] ?? null;
        }

        $this->data['items'] = $items;
        $this->data['pager'] = $this->model->pager;
        $this->data['types'] = ProductModel::TYPES;
        $this->data['type']  = $type;
        $this->data['q']     = $search;

        return view('admin/products/index', $this->data);
    }

    public function create()
    {
        $this->data['title']       = 'Tambah Product';
        $this->data['item']        = [];
        $this->data['images']      = [];
        $this->data['results']     = [];
        $this->data['marketplace'] = [];
        $this->data['types']       = ProductModel::TYPES;

        return view('admin/products/form', $this->data);
    }

    public function store()
    {
        $data = $this->collectProductData();

        if (! $this->model->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $id = $this->service->save($data, $this->request->getPost('marketplace') ?? []);

        (new AuditService())->log('create', 'Product', $id, null, $data);

        $this->replaceProductPhoto($id);
        $this->uploadFilesFromRequest($id, 'new_result_images', 'result', false);

        return redirect()->to('admin/products/' . $id . '/edit')->with('message', 'Product berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        if ($item === null) {
            return redirect()->to('admin/products')->with('error', 'Product tidak ditemukan.');
        }

        $links       = $this->model->marketplaceLinks((int) $id);
        $marketplace = [];
        foreach ($links as $link) {
            $marketplace[$link['platform']] = $link['url'];
        }

        $this->data['title']       = 'Edit Product';
        $this->data['item']        = $item;
        $this->data['images']      = $this->model->images((int) $id, 'product');
        $this->data['results']     = $this->model->images((int) $id, 'result');
        $this->data['marketplace'] = $marketplace;
        $this->data['types']       = ProductModel::TYPES;

        return view('admin/products/form', $this->data);
    }

    public function update($id)
    {
        $old  = $this->model->find($id);
        $data = $this->collectProductData();

        if (! $this->model->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $this->service->save($data, $this->request->getPost('marketplace') ?? [], (int) $id);

        (new AuditService())->log('update', 'Product', (int) $id, $old, $data);

        $this->replaceProductPhoto((int) $id);
        $this->uploadFilesFromRequest((int) $id, 'new_result_images', 'result', false);

        return redirect()->to('admin/products/' . $id . '/edit')->with('message', 'Product berhasil diperbarui.');
    }

    public function delete($id)
    {
        $old = $this->model->find($id);
        $this->model->delete($id);

        (new AuditService())->log('delete', 'Product', (int) $id, $old, null);

        return redirect()->to('admin/products')->with('message', 'Product berhasil dihapus.');
    }

    public function toggleFeatured($id)
    {
        $item = $this->model->find($id);
        if ($item === null) {
            return redirect()->to('admin/products');
        }

        $newValue = empty($item['is_featured']) ? 1 : 0;
        $this->model->update($id, ['is_featured' => $newValue]);

        (new AuditService())->log('update', 'Product', (int) $id, ['is_featured' => $item['is_featured']], ['is_featured' => $newValue]);

        return redirect()->back()->with('message', 'Status unggulan berhasil diubah.');
    }

    public function deleteImage($id, $imageId)
    {
        $this->service->removeImage((int) $imageId);

        (new AuditService())->log('delete', 'ProductImage', (int) $imageId, null, null);

        return redirect()->to('admin/products/' . $id . '/edit')->with('message', 'Gambar berhasil dihapus.');
    }

    /**
     * Only one product photo is allowed: replaces whatever is there (if
     * anything) with the newly uploaded file, in one shot, as part of the
     * regular Save action — there is no separate "Upload" button anymore.
     */
    private function replaceProductPhoto(int $productId): void
    {
        $file = $this->request->getFile('new_images');
        if ($file === null || ! $file->isValid()) {
            return;
        }

        foreach ($this->model->images($productId, 'product') as $old) {
            $this->service->removeImage((int) $old['id']);
            (new AuditService())->log('delete', 'ProductImage', (int) $old['id'], $old, null);
        }

        $image = $this->service->addImage($productId, $file, 'product', true);
        (new AuditService())->log('create', 'ProductImage', $image['id'], null, $image);
    }

    private function uploadFilesFromRequest(int $productId, string $fieldName, string $kind, bool $firstIsPrimary): void
    {
        $files = array_filter(
            $this->request->getFileMultiple($fieldName) ?? [],
            static fn ($f) => $f !== null && $f->isValid()
        );

        foreach (array_values($files) as $i => $file) {
            $image = $this->service->addImage($productId, $file, $kind, $firstIsPrimary && $i === 0);
            (new AuditService())->log('create', 'ProductImage', $image['id'], null, $image);
        }
    }

    private function collectProductData(): array
    {
        return [
            'type'        => $this->request->getPost('type'),
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status') ?: 'active',
        ];
    }
}
