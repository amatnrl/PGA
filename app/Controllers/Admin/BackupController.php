<?php

namespace App\Controllers\Admin;

use App\Services\AuditService;
use App\Services\BackupService;

class BackupController extends AdminBaseController
{
    private BackupService $service;

    public function __construct()
    {
        $this->service = new BackupService();
    }

    public function index()
    {
        $this->data['title']   = 'Backup Management';
        $this->data['backups'] = $this->service->listBackups();

        return view('admin/backups/index', $this->data);
    }

    public function create()
    {
        $result = $this->service->createBackup();

        (new AuditService())->log('create', 'Backup', null, null, $result);

        return redirect()->to('admin/backups')->with('message', 'Backup baru berhasil dibuat.');
    }

    public function download($name)
    {
        $path = $this->service->getFilePath($name);

        if ($path === null) {
            return redirect()->to('admin/backups')->with('error', 'File backup tidak ditemukan.');
        }

        return $this->response->download($path, null);
    }

    public function delete($name)
    {
        $this->service->deleteBackup($name);

        (new AuditService())->log('delete', 'Backup', null, null, ['file' => $name]);

        return redirect()->to('admin/backups')->with('message', 'Backup berhasil dihapus.');
    }
}
