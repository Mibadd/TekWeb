<?php

namespace App\Controllers;

use App\Models\ManajemenJadwalModel;
use App\Models\SukuCadangModel;
use CodeIgniter\Controller;

class ManajemenJadwal extends Controller
{
    protected $jadwalModel;
    protected $sukuCadangModel;
    protected $db;

    public function __construct()
    {
        $this->jadwalModel = new ManajemenJadwalModel();
        $this->sukuCadangModel = new SukuCadangModel();
        $this->db = \Config\Database::connect();
    }

    // Menampilkan daftar jadwal
    public function index()
    {
        $jadwalModel = new ManajemenJadwalModel();
        $sukucadangModel = new SukuCadangModel();

        // Ambil semua jadwal
        $jadwalList = $jadwalModel->findAll();

        // Ambil relasi suku cadang untuk masing-masing jadwal
        $db = \Config\Database::connect();
        $builder = $db->table('jadwal_sukucadang');
        $builder->select('jadwal_id, sukucadang.nama');
        $builder->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id');
        $result = $builder->get()->getResultArray();

        // Kelompokkan suku cadang berdasarkan jadwal_id
        $sukucadangPerJadwal = [];
        foreach ($result as $row) {
            $sukucadangPerJadwal[$row['jadwal_id']][] = $row['nama'];
        }

        return view('admin/manajemenjadwal', [
            'jadwalList' => $jadwalList,
            'sukucadangPerJadwal' => $sukucadangPerJadwal
        ]);
    }

    // Mengupdate status & suku cadang
    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'status' => $this->request->getPost('status'),
        ];

        $this->jadwalModel->update($id, $data);

        // Hapus relasi lama
        $builder = $this->db->table('jadwal_sukucadang');
        $builder->where('jadwal_id', $id)->delete();

        // Tambah relasi baru
        $sukuCadangIds = $this->request->getPost('sukucadang') ?? [];
        foreach ($sukuCadangIds as $sukuId) {
            $builder->insert([
                'jadwal_id' => $id,
                'sukucadang_id' => $sukuId
            ]);
        }

        return redirect()->to('/manajemenjadwal');
    }

    // Menampilkan form edit data jadwal
    public function edit($id)
    {
        $jadwalModel = new ManajemenJadwalModel();
        $sukuCadangModel = new SukuCadangModel();

        $jadwal = $jadwalModel->find($id);
        $sukuCadang = $sukuCadangModel->findAll(); // Pastikan ini dipanggil

        if (!$jadwal) {
            return redirect()->to('/admin/manajemenjadwal')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/jadwal/editjadwal', [
            'jadwal' => $jadwal,
            'sukuCadang' => $sukuCadang // pastikan ini dikirim
        ]);
    }
    // Menyimpan hasil edit data jadwal
    public function updateDetail($id)
    {
        $data = [
            'jenis_motor'   => $this->request->getPost('jenis_motor'),
            'tanggal'       => $this->request->getPost('tanggal'),
            'jam'           => $this->request->getPost('jam'),
            'jenis_servis'  => $this->request->getPost('jenis_servis'),
            'status'        => $this->request->getPost('status'), // ⬅ tambahkan ini
        ];

        $this->jadwalModel->update($id, $data);

        return redirect()->to('/manajemenjadwal')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function formTambah()
    {
        $sukucadangModel = new \App\Models\SukuCadangModel();
        $data['sukucadang'] = $sukucadangModel->findAll();

        return view('admin/jadwal/tambahjadwal', $data);
    }

    public function tambah()
    {
        $data = [
            'jenis_motor' => $this->request->getPost('jenis_motor'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'jenis_servis' => $this->request->getPost('jenis_servis'),
            'status' => $this->request->getPost('status')
        ];

        // Simpan data jadwal servis
        $this->jadwalModel->insert($data);
        $jadwalId = $this->jadwalModel->getInsertID();

        // Ambil suku cadang terpilih
        $sukuCadangIds = $this->request->getPost('id_sukucadang');

        if (!empty($sukuCadangIds)) {
            foreach ($sukuCadangIds as $sukuId) {
                $suku = $this->sukuCadangModel->find($sukuId);
                if ($suku && $suku['stok'] > 0) {
                    // Kurangi stok
                    $this->sukuCadangModel->update($sukuId, [
                        'stok' => $suku['stok'] - 1
                    ]);

                    // Simpan relasi
                    $this->db->table('jadwal_sukucadang')->insert([
                        'jadwal_id' => $jadwalId,
                        'sukucadang_id' => $sukuId
                    ]);
                }
            }
        }

        return redirect()->to('/manajemenjadwal')->with('success', 'Jadwal servis berhasil ditambahkan.');
    }
        // Menghapus data jadwal
    public function delete($id)
    {
        // Hapus relasi dari tabel pivot jika ada
        $this->db->table('jadwal_sukucadang')->where('jadwal_id', $id)->delete();

        // Hapus data jadwal utama
        $this->jadwalModel->delete($id);

        return redirect()->to('/manajemenjadwal')->with('success', 'Jadwal berhasil dihapus.');
    }
    public function detail($id)
    {
        $jadwal = $this->jadwalModel->find($id);
        if (!$jadwal) {
            return redirect()->to('/manajemenjadwal')->with('error', 'Jadwal tidak ditemukan.');
        }

        // Ambil suku cadang yang terhubung
        $builder = $this->db->table('jadwal_sukucadang');
        $builder->select('sukucadang.nama');
        $builder->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id');
        $builder->where('jadwal_id', $id);
        $result = $builder->get()->getResultArray();

        $sukucadangList = array_column($result, 'nama');

        return view('admin/detailservice', [
            'jadwal' => $jadwal,
            'sukucadangList' => $sukucadangList
        ]);
    }
}

