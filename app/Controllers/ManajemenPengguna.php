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

    // Menampilkan halaman utama manajemen pengguna
    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/manajemenpengguna', $data);
    }

    // Menampilkan form tambah pengguna
    public function formTambah()
    {
        return view('admin/tambahpengguna');
    }

    // Menampilkan form edit pengguna
    public function formEdit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('admin/manajemenpengguna'))->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('admin/editpengguna', ['user' => $user]);
    }

    // Proses tambah pengguna
    public function tambah()
    {
        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'  => $this->request->getPost('role'),
        ];

        $this->userModel->insert($data);

        return redirect()->to(base_url('admin/manajemenpengguna'))->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Proses edit pengguna
    public function edit()
    {
        $id = $this->request->getPost('id');

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'  => $this->request->getPost('role'),
        ];

        $this->userModel->update($id, $data);

        return redirect()->to(base_url('admin/manajemenpengguna'))->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Hapus pengguna
    public function hapus($id)
    {
        $user = $this->userModel->find($id);

        if ($user) {
            $this->userModel->delete($id);
            return redirect()->to(base_url('admin/manajemenpengguna'))->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->to(base_url('admin/manajemenpengguna'))->with('error', 'Pengguna tidak ditemukan.');
        }
    }
}
