<?php

namespace App\Controllers;

use App\Models\KendaraanModel;

class DataKendaraanController extends BaseController
{
    public function index()
    {
        $model = new KendaraanModel();
        $data['kendaraan'] = $model->findAll(); // Ambil semua data kendaraan

        return view('admin/datakendaraan', $data); // Tampilkan view dengan data kendaraan
    }

    public function add()
    {
        return view('admin/tambahkendaraan'); // Halaman untuk tambah kendaraan
    }

    public function store()
    {
        $model = new KendaraanModel();

        // Ambil data dari form
        $data = [
            'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
            'kategori' => $this->request->getPost('kategori'),
            'stok' => $this->request->getPost('stok'),
            'harga' => $this->request->getPost('harga')
        ];

        // Simpan data ke database
        $model->save($data);

        return redirect()->to('/datakendaraan'); // Redirect ke halaman daftar kendaraan
    }

    public function edit($id)
    {
        $model = new KendaraanModel();
        $data['kendaraan'] = $model->find($id); // Ambil data kendaraan berdasarkan ID

        return view('admin/editkendaraan', $data); // Halaman edit kendaraan
    }

    public function update($id)
    {
        $model = new KendaraanModel();

        // Ambil data dari form
        $data = [
            'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
            'kategori' => $this->request->getPost('kategori'),
            'stok' => $this->request->getPost('stok'),
            'harga' => $this->request->getPost('harga')
        ];

        // Update data kendaraan berdasarkan ID
        $model->update($id, $data);

        return redirect()->to('/datakendaraan'); // Redirect ke halaman daftar kendaraan
    }

    public function delete($id)
    {
        $model = new KendaraanModel();
        $model->delete($id); // Hapus kendaraan berdasarkan ID

        return redirect()->to('/datakendaraan'); // Redirect ke halaman daftar kendaraan
    }
}
