<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        // Cek login & role superadmin
        if (!session()->get('logged_in') || session()->get('role') != 'superadmin') {
            exit('Akses ditolak. Halaman ini hanya untuk Superadmin.');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];
        return view('admin/user', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();
        $saveData = [
            'username' => $data['username'],
            'role' => $data['role'],
        ];

        if (!empty($data['password'])) {
            $saveData['password'] = md5($data['password']);
        }

        if (empty($data['id'])) {
            $this->userModel->insert($saveData);
        } else {
            $this->userModel->update($data['id'], $saveData);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        return $this->response->setJSON($user);
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to(base_url('admin/user'));
    }
}
