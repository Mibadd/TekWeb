<?php

namespace App\Controllers;

use App\Models\UserModel;

class ManajemenPengguna extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/manajemenpengguna', $data);
    }

    public function tambah()
    {
    $data = [
        'name' => $this->request->getPost('name'),
        'email'=> $this->request->getPost('email'),
        'role' => $this->request->getPost('role'),
    ];

    // Validasi sederhana bisa kamu tambahkan sesuai kebutuhan

    $this->userModel->insert($data);

    return redirect()->to('/manajemenpengguna')->with('success', 'User added successfully.');
    }


    public function edit()
    {
    $id = $this->request->getPost('id');
    $userModel = new UserModel();

    $data = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'role' => $this->request->getPost('role'),
    ];

    $userModel->update($id, $data);

    return redirect()->to(base_url('admin/manajemenpengguna'))->with('success', 'Data pengguna berhasil diperbarui.');
    }


    public function hapus($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            $userModel->delete($id);
            return redirect()->to(base_url('admin/manajemenpengguna'))->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->to(base_url('admin/manajemenpengguna'))->with('error', 'Pengguna tidak ditemukan.');
        }
    }
}
