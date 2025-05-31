<?php

namespace App\Controllers;

use App\Models\SukuCadangModel;

class SukuCadang extends BaseController
{
    protected $sukuCadangModel;

    public function __construct()
    {
        $this->sukuCadangModel = new SukuCadangModel();
    }

    public function index()
    {
        $filter_kategori = $this->request->getGet('filter_kategori');
        $filter_nama = $this->request->getGet('filter_nama');

        $builder = $this->sukuCadangModel;

        if (!empty($filter_kategori)) {
            $builder = $builder->where('kategori', $filter_kategori);
        }

        if (!empty($filter_nama)) {
            $builder = $builder->like('nama', $filter_nama);
        }

        $data['sukucadang'] = $builder->findAll();
        $data['filter_kategori'] = $filter_kategori;
        $data['filter_nama'] = $filter_nama;

        return view('admin/sukucadang/index', $data);
    }

    public function tambah()
    {
        // Validasi input
        if (!$this->validate([
            'kode' => 'required|max_length[10]',
            'nama_sukucadang' => 'required|max_length[100]',
            'kategori' => 'required|max_length[50]',
            'stok' => 'required|integer',
            'harga' => 'required|decimal',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->request->getPost('kode');
        $nama = $this->request->getPost('nama_sukucadang');
        $kategori = $this->request->getPost('kategori');
        $stok = (int) $this->request->getPost('stok');
        $harga = $this->request->getPost('harga');

        // Status enum sesuai database, huruf kecil semua
        if ($stok > 5) {
            $status = 'tersedia';
        } elseif ($stok > 0) {
            $status = 'menipis';
        } else {
            $status = 'habis';
        }

        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'kategori' => $kategori,
            'stok' => $stok,
            'harga' => $harga,
            'status' => $status,
        ];

        $this->sukuCadangModel->insert($data);

        return redirect()->to(base_url('admin/sukucadang'))->with('success', 'Suku Cadang berhasil ditambahkan.');
    }

    public function getById($id)
    {
        $data = $this->sukuCadangModel->find($id);
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan']);
        }
    }

    public function edit()
    {
        // Validasi input
        if (!$this->validate([
            'id' => 'required|integer',
            'kode' => 'required|max_length[10]',
            'nama_sukucadang' => 'required|max_length[100]',
            'kategori' => 'required|max_length[50]',
            'stok' => 'required|integer',
            'harga' => 'required|decimal',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = $this->request->getPost('id');
        $stok = (int) $this->request->getPost('stok');

        if ($stok > 5) {
            $status = 'tersedia';
        } elseif ($stok > 0) {
            $status = 'menipis';
        } else {
            $status = 'habis';
        }

        $data = [
            'kode'     => $this->request->getPost('kode'),
            'nama'     => $this->request->getPost('nama_sukucadang'),
            'kategori' => $this->request->getPost('kategori'),
            'stok'     => $stok,
            'harga'    => $this->request->getPost('harga'),
            'status'   => $status,
        ];

        $success = $this->sukuCadangModel->update($id, $data);

        if ($success) {
            return redirect()->to(base_url('admin/sukucadang'))->with('success', 'Suku Cadang berhasil diperbarui.');
        } else {
            return redirect()->to(base_url('admin/sukucadang'))->with('error', 'Gagal memperbarui Suku Cadang.');
        }
    }

    public function hapus($id)
    {
        $sukucadang = $this->sukuCadangModel->find($id);

        if ($sukucadang) {
            $this->sukuCadangModel->delete($id);
            return redirect()->to(base_url('admin/sukucadang'))->with('success', 'Suku Cadang berhasil dihapus.');
        } else {
            return redirect()->to(base_url('admin/sukucadang'))->with('error', 'Suku Cadang tidak ditemukan.');
        }
    }
}
