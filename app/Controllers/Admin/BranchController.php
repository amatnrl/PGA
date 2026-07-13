<?php

namespace App\Controllers\Admin;

use App\Models\BranchModel;
use App\Services\AuditService;

class BranchController extends AdminBaseController
{
    private BranchModel $model;

    public function __construct()
    {
        $this->model = new BranchModel();
    }

    public function index()
    {
        $this->data['title'] = 'Jalur Distribusi';

        $region = trim((string) $this->request->getGet('region'));
        $search = trim((string) $this->request->getGet('q'));
        $status = trim((string) $this->request->getGet('status'));

        $builder = $this->model->orderBy('region', 'asc')->orderBy('city', 'asc');

        if ($region !== '') {
            $builder->where('region', $region);
        }

        if ($status !== '') {
            $builder->where('status', $status);
        }

        if ($search !== '') {
            $builder->groupStart()
                ->like('city', $search)
                ->orLike('region', $search)
                ->groupEnd();
        }

        $this->data['items']    = $builder->paginate(20);
        $this->data['pager']    = $this->model->pager;
        $this->data['q']        = $search;
        $this->data['region']   = $region;
        $this->data['status']   = $status;
        $this->data['regions']  = $this->model->select('region')->distinct()->orderBy('region', 'asc')->findColumn('region') ?? [];

        return view('admin/branches/index', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Tambah Jalur Distribusi';
        $this->data['item']  = [
            'region' => '',
            'city' => '',
            'status' => 'active',
        ];

        return view('admin/branches/form', $this->data);
    }

    public function store()
    {
        $data = $this->validatedInput();
        if ($data === null) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $id = $this->model->insert($data, true);

        (new AuditService())->log('create', 'Branch', (int) $id, null, $data);

        return redirect()->to('admin/branches')->with('message', 'Jalur distribusi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = $this->model->find((int) $id);
        if ($item === null) {
            return redirect()->to('admin/branches')->with('error', 'Data jalur distribusi tidak ditemukan.');
        }

        $this->data['title'] = 'Edit Jalur Distribusi';
        $this->data['item']  = $item;

        return view('admin/branches/form', $this->data);
    }

    public function update($id)
    {
        $id   = (int) $id;
        $old  = $this->model->find($id);

        if ($old === null) {
            return redirect()->to('admin/branches')->with('error', 'Data jalur distribusi tidak ditemukan.');
        }

        $data = $this->validatedInput();
        if ($data === null) {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }

        $this->model->update($id, $data);

        (new AuditService())->log('update', 'Branch', $id, $old, $data);

        return redirect()->to('admin/branches')->with('message', 'Jalur distribusi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $id  = (int) $id;
        $old = $this->model->find($id);

        if ($old === null) {
            return redirect()->to('admin/branches')->with('error', 'Data jalur distribusi tidak ditemukan.');
        }

        $this->model->delete($id);

        (new AuditService())->log('delete', 'Branch', $id, $old, null);

        return redirect()->to('admin/branches')->with('message', 'Jalur distribusi berhasil dihapus.');
    }

    private function validatedInput(): ?array
    {
        $data = [
            'region' => trim((string) $this->request->getPost('region')),
            'city'   => trim((string) $this->request->getPost('city')),
            'status' => $this->request->getPost('status') ?: 'active',
        ];

        if (! $this->model->validate($data)) {
            return null;
        }

        return $data;
    }
}
