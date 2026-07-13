<?php

namespace App\Controllers\Admin;

use App\Libraries\ImageProcessor;
use App\Services\AuditService;
use CodeIgniter\Model;

/**
 * Shared CRUD for the "simple content" modules: Baking Insight, Recipe,
 * Article, Activity. All four share the exact same shape: title, content
 * (WYSIWYG), a single featured photo, updated_by, published_at, status.
 */
abstract class ContentCrudController extends AdminBaseController
{
    protected Model $model;
    protected string $redirectUrl;
    protected string $moduleTitle;
    protected string $auditModel;

    public function index()
    {
        $this->data['title']       = $this->moduleTitle;
        $this->data['moduleTitle'] = $this->moduleTitle;
        $this->data['redirectUrl'] = $this->redirectUrl;

        $search = $this->request->getGet('q');
        $status = $this->request->getGet('status');

        $builder = $this->model->orderBy('id', 'desc');
        if ($search) {
            $builder->like('title', $search);
        }
        if ($status) {
            $builder->where('status', $status);
        }

        $this->data['items']  = $builder->paginate(15);
        $this->data['pager']  = $this->model->pager;
        $this->data['q']      = $search;
        $this->data['status'] = $status;

        return view('admin/content/index', $this->data);
    }

    public function create()
    {
        $this->data['title']       = 'Tambah ' . $this->moduleTitle;
        $this->data['moduleTitle'] = $this->moduleTitle;
        $this->data['redirectUrl'] = $this->redirectUrl;
        $this->data['item']        = [
            'published_at' => date('Y-m-d'),
            'updated_by'   => $this->currentAdminName(),
        ];
        $this->data = array_merge($this->data, $this->extraFormData(null));

        return view('admin/content/form', $this->data);
    }

    public function store()
    {
        $data = $this->collectInput();

        if (! $this->model->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $this->applyImageUpload($data, null);

        $data['slug'] = $this->model->generateUniqueSlug($data['title']);
        $id           = $this->model->insert($data, true);

        (new AuditService())->log('create', $this->auditModel, $id, null, $data);

        $this->afterSave((int) $id, true);

        return redirect()->to($this->redirectUrl)->with('message', $this->moduleTitle . ' berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        if ($item === null) {
            return redirect()->to($this->redirectUrl)->with('error', 'Data tidak ditemukan.');
        }

        $this->data['title']       = 'Edit ' . $this->moduleTitle;
        $this->data['moduleTitle'] = $this->moduleTitle;
        $this->data['redirectUrl'] = $this->redirectUrl;
        $this->data['item']        = $item;
        $this->data = array_merge($this->data, $this->extraFormData($item));

        return view('admin/content/form', $this->data);
    }

    public function update($id)
    {
        $old  = $this->model->find($id);
        $data = $this->collectInput();

        if (! $this->model->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $this->applyImageUpload($data, $old);

        if ($data['title'] !== ($old['title'] ?? null)) {
            $data['slug'] = $this->model->generateUniqueSlug($data['title'], (int) $id);
        }

        $this->model->update($id, $data);

        (new AuditService())->log('update', $this->auditModel, (int) $id, $old, $data);

        $this->afterSave((int) $id, false);

        return redirect()->to($this->redirectUrl)->with('message', $this->moduleTitle . ' berhasil diperbarui.');
    }

    /**
     * Extra data merged into the create/edit form view. Override in a
     * subclass for module-specific fields (e.g. Recipe's product picker).
     */
    protected function extraFormData(?array $item): array
    {
        return [];
    }

    /**
     * Hook run right after a create/update is persisted. Override in a
     * subclass to save related data (e.g. Recipe's linked products).
     */
    protected function afterSave(int $id, bool $isNew): void
    {
    }

    public function delete($id)
    {
        $old = $this->model->find($id);

        if ($old !== null && ! empty($old['featured_image'])) {
            (new ImageProcessor())->delete([$old['featured_image']]);
        }

        $this->model->delete($id);

        (new AuditService())->log('delete', $this->auditModel, (int) $id, $old, null);

        return redirect()->to($this->redirectUrl)->with('message', $this->moduleTitle . ' berhasil dihapus.');
    }

    protected function collectInput(): array
    {
        return [
            'title'        => $this->request->getPost('title'),
            'content'      => $this->request->getPost('content'),
            'status'       => $this->request->getPost('status') ?: 'draft',
            'published_at' => $this->request->getPost('published_at') ?: date('Y-m-d'),
            'updated_by'   => $this->currentAdminName(),
        ];
    }

    private function applyImageUpload(array &$data, ?array $old): void
    {
        $file = $this->request->getFile('featured_image_file');

        if ($file === null || ! $file->isValid()) {
            return;
        }

        $destDir  = FCPATH . 'uploads/' . $this->auditModel;
        $baseName = bin2hex(random_bytes(8));
        $path     = (new ImageProcessor())->toWebpFullRes($file->getTempName(), $destDir, $baseName);

        if ($old !== null && ! empty($old['featured_image'])) {
            (new ImageProcessor())->delete([$old['featured_image']]);
        }

        $data['featured_image'] = $path;
    }

    private function currentAdminName(): string
    {
        $user = $this->data['currentUser'] ?? auth()->user();

        return $user->username ?? 'Admin';
    }
}
