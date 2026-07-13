<?php

namespace App\Controllers\Admin;

use App\Services\AuditService;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class UserController extends AdminBaseController
{
    private UserModel $model;
    private array $groups = ['superadmin', 'admin', 'editor'];

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        $this->data['title'] = 'User Management';
        $users                 = $this->model->orderBy('id', 'desc')->findAll();

        $this->data['items'] = array_map(fn ($u) => [
            'id'       => $u->id,
            'username' => $u->username,
            'email'    => $u->getEmail(),
            'active'   => $u->isActivated(),
            'groups'   => $u->getGroups(),
        ], $users);

        return view('admin/users/index', $this->data);
    }

    public function create()
    {
        $this->data['title']  = 'Tambah User';
        $this->data['item']   = [];
        $this->data['groups'] = $this->groups;

        return view('admin/users/form', $this->data);
    }

    public function store()
    {
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[8]',
            'group'    => 'required|in_list[' . implode(',', $this->groups) . ']',
        ];

        if (! $this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = new User([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        $this->model->save($user);
        $user = $this->model->findById($this->model->getInsertID());
        $user->addGroup($this->request->getPost('group'));
        $this->model->activate($user);

        (new AuditService())->log('create', 'User', $user->id, null, ['username' => $user->username, 'group' => $this->request->getPost('group')]);

        return redirect()->to('admin/users')->with('message', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = $this->model->findById($id);
        if ($user === null) {
            return redirect()->to('admin/users')->with('error', 'User tidak ditemukan.');
        }

        $this->data['title']  = 'Edit User';
        $this->data['item']   = ['id' => $user->id, 'username' => $user->username, 'email' => $user->getEmail(), 'group' => $user->getGroups()[0] ?? ''];
        $this->data['groups'] = $this->groups;

        return view('admin/users/form', $this->data);
    }

    public function update($id)
    {
        $user = $this->model->findById($id);
        if ($user === null) {
            return redirect()->to('admin/users');
        }

        $newGroup = $this->request->getPost('group');
        foreach ($user->getGroups() ?? [] as $g) {
            $user->removeGroup($g);
        }
        if ($newGroup) {
            $user->addGroup($newGroup);
        }

        $password = $this->request->getPost('password');
        if ($password) {
            $user->setPassword($password);
            $this->model->save($user);
        }

        (new AuditService())->log('update', 'User', (int) $id, null, ['group' => $newGroup]);

        return redirect()->to('admin/users')->with('message', 'User berhasil diperbarui.');
    }

    public function delete($id)
    {
        if ((int) $id === auth()->user()->id) {
            return redirect()->to('admin/users')->with('error', 'Tidak bisa menghapus akun Anda sendiri.');
        }

        $this->model->delete($id);

        (new AuditService())->log('delete', 'User', (int) $id, null, null);

        return redirect()->to('admin/users')->with('message', 'User berhasil dihapus.');
    }
}
