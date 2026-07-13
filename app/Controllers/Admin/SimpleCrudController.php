<?php

namespace App\Controllers\Admin;

use App\Libraries\ImageProcessor;
use App\Services\AuditService;
use CodeIgniter\Model;

/**
 * Generic CRUD for single-table modules with an identical shape:
 * list+search, create, edit, toggle status, delete.
 * Subclasses only need to set the properties below.
 */
abstract class SimpleCrudController extends AdminBaseController
{
    protected Model $model;
    protected string $viewPath;       // e.g. 'admin/banners'
    protected string $redirectUrl;    // e.g. 'admin/banners'
    protected string $moduleTitle;    // e.g. 'Banner'
    protected string $auditModel;     // e.g. 'Banner'
    protected array $searchFields = ['name']; // columns used by the search box

    /**
     * DB columns that store an uploaded image path. Each gets a file input
     * named "{column}_file" in the form, converted to full-resolution WEBP.
     */
    protected array $fileFields = [];

    public function index()
    {
        $this->data['title'] = $this->moduleTitle;
        $search               = $this->request->getGet('q');

        $builder = $this->model->orderBy('id', 'desc');
        if ($search && $this->searchFields !== []) {
            $builder->groupStart();
            foreach ($this->searchFields as $i => $field) {
                $i === 0 ? $builder->like($field, $search) : $builder->orLike($field, $search);
            }
            $builder->groupEnd();
        }

        $this->data['items'] = $builder->paginate(15);
        $this->data['pager'] = $this->model->pager;

        return view($this->viewPath . '/index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Tambah ' . $this->moduleTitle;
        $this->data['item']  = [];

        return view($this->viewPath . '/form', $this->data);
    }

    public function store()
    {
        $data = $this->collectInput();
        $this->applyFileUploads($data, null);

        if (! $this->model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        (new AuditService())->log('create', $this->auditModel, $this->model->getInsertID(), null, $data);

        return redirect()->to($this->redirectUrl)->with('message', $this->moduleTitle . ' berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        if ($item === null) {
            return redirect()->to($this->redirectUrl)->with('error', 'Data tidak ditemukan.');
        }

        $this->data['title'] = 'Edit ' . $this->moduleTitle;
        $this->data['item']  = $item;

        return view($this->viewPath . '/form', $this->data);
    }

    public function update($id)
    {
        $old  = $this->model->find($id);
        $data = $this->collectInput();
        $this->applyFileUploads($data, $old);

        if (! $this->model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        (new AuditService())->log('update', $this->auditModel, (int) $id, $old, $data);

        return redirect()->to($this->redirectUrl)->with('message', $this->moduleTitle . ' berhasil diperbarui.');
    }

    public function delete($id)
    {
        $old = $this->model->find($id);

        foreach ($this->fileFields as $field) {
            if (! empty($old[$field])) {
                (new ImageProcessor())->delete([$old[$field]]);
            }
        }

        $this->model->delete($id);

        (new AuditService())->log('delete', $this->auditModel, (int) $id, $old, null);

        return redirect()->to($this->redirectUrl)->with('message', $this->moduleTitle . ' berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $item = $this->model->find($id);
        if ($item === null) {
            return redirect()->to($this->redirectUrl);
        }

        $newStatus = ($item['status'] ?? 'active') === 'active' ? 'inactive' : 'active';
        $this->model->update($id, ['status' => $newStatus]);

        (new AuditService())->log('update', $this->auditModel, (int) $id, ['status' => $item['status']], ['status' => $newStatus]);

        return redirect()->to($this->redirectUrl)->with('message', 'Status berhasil diubah.');
    }

    /**
     * Collects POST fields matching the model's allowedFields.
     */
    protected function collectInput(): array
    {
        $allowed = $this->model->allowedFields;
        $data    = [];

        foreach ($allowed as $field) {
            if (in_array($field, $this->fileFields, true)) {
                continue; // handled separately by applyFileUploads()
            }
            if ($this->request->getPost($field) !== null) {
                $data[$field] = $this->request->getPost($field);
            }
        }

        return $data;
    }

    /**
     * Processes any uploaded files declared in $fileFields: converts to
     * full-resolution WEBP, removes the previous file when replaced.
     */
    private function applyFileUploads(array &$data, ?array $old): void
    {
        foreach ($this->fileFields as $field) {
            $file = $this->request->getFile($field . '_file');

            if ($file === null || ! $file->isValid()) {
                continue;
            }

            $destDir  = FCPATH . 'uploads/' . strtolower($this->auditModel);
            $baseName = bin2hex(random_bytes(8));
            $path     = (new ImageProcessor())->toWebpFullRes($file->getTempName(), $destDir, $baseName);

            if ($old !== null && ! empty($old[$field])) {
                (new ImageProcessor())->delete([$old[$field]]);
            }

            $data[$field] = $path;
        }
    }
}
