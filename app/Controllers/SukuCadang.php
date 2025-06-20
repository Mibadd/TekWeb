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
    $kategori = $this->request->getGet('kategori');
    $status   = $this->request->getGet('status');
    $nama     = $this->request->getGet('nama');

    $builder = $this->sukuCadangModel;

    if ($kategori !== null && $kategori !== '') {
        $builder = $builder->where('kategori', $kategori);
    }

    if ($status !== null && $status !== '') {
        $builder = $builder->where('status', $status);
    }

    if ($nama !== null && $nama !== '') {
        $builder = $builder->like('nama', $nama);
    }

    $data = [
        'sukucadang' => $builder->findAll(),
        'kategori'   => $kategori,
        'status'     => $status,
        'nama'       => $nama,
    ];

    return view('admin/sukucadang', $data);
}
    public function getDetailByJadwal($jadwalId)
    {
        return $this->select('sukucadang.nama, sukucadang.harga, jadwal_sukucadang.jumlah')
                    ->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id')
                    ->where('jadwal_sukucadang.jadwal_id', $jadwalId)
                    ->findAll();
    }


    public function tambah()
{
    $kode     = $this->generateKodeSukuCadang(); // Otomatis
    $nama     = $this->request->getPost('nama');
    $kategori = $this->request->getPost('kategori');
    $stok     = (int) $this->request->getPost('stok');
    $harga    = (int) $this->request->getPost('harga');

    // Set status otomatis
    if ($stok > 5) {
        $status = 'Tersedia';
    } elseif ($stok > 0) {
        $status = 'Stok Menipis';
    } else {
        $status = 'Habis';
    }

    $data = [
        'kode'     => $kode,
        'nama'     => $nama,
        'kategori' => $kategori,
        'stok'     => $stok,
        'harga'    => $harga,
        'status'   => $status,
    ];

    $this->sukuCadangModel->insert($data);

    return redirect()->to(base_url('admin/sukucadang'))->with('success', 'Suku Cadang berhasil ditambahkan.');
}

private function generateKodeSukuCadang()
{
    $last = $this->sukuCadangModel->orderBy('id', 'DESC')->first();
    $lastId = $last ? $last['id'] : 0;
    $nextId = $lastId + 1;

    return 'SCD-' . str_pad($nextId, 3, '0', STR_PAD_LEFT); // Contoh: SCD-001
}


    // Fungsi untuk mengambil data untuk form edit
    public function getById($id)
    {
        $data = $this->sukuCadangModel->find($id);
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan']);
        }
    }

    // Fungsi untuk menyimpan hasil edit
    public function edit()
    {
        $id = $this->request->getPost('id');
        $stok = (int) $this->request->getPost('stok');
        
        // Set status otomatis berdasarkan stok
        if ($stok > 5) {
            $status = 'Tersedia';
        } elseif ($stok > 0) {
            $status = 'Stok Menipis';
        } else {
            $status = 'Habis';
        }
        
        $data = [
            'kode'     => $this->request->getPost('kode'),
            'nama'     => $this->request->getPost('nama_sukucadang'),
            'kategori' => $this->request->getPost('kategori'),
            'stok'     => $stok,
            'harga'    => (int) $this->request->getPost('harga'),
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
