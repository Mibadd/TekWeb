<?php

namespace App\Controllers;

// Ganti model yang digunakan ke ManajemenJadwalModel
use App\Models\ManajemenJadwalModel; 
use App\Models\JadwalSukuCadangModel;

class ServiceScheduleController extends BaseController
{
    /**
     * Menampilkan daftar semua jadwal servis yang tersedia untuk pengguna.
     */
    public function index()
    {
        // Gunakan ManajemenJadwalModel untuk mengambil data
        $jadwalModel = new ManajemenJadwalModel();
        $jadwalSukuCadangModel = new JadwalSukuCadangModel();

        // Ambil semua jadwal yang statusnya 'Tersedia' untuk ditampilkan ke user
        $jadwals = $jadwalModel->where('status', 'Tersedia')
                               ->orderBy('tanggal', 'ASC') // Urutkan dari yang paling dekat
                               ->findAll();

        // (Opsional) Jika Anda ingin menampilkan suku cadang di halaman list
        foreach ($jadwals as $key => $jadwal) {
            $sukuCadangDipakai = $jadwalSukuCadangModel
                ->select('sukucadang.nama, jadwal_sukucadang.jumlah, sukucadang.harga')
                ->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id')
                ->where('jadwal_sukucadang.jadwal_id', $jadwal['id'])
                ->findAll();

            $jadwals[$key]['suku_cadang_dipakai'] = $sukuCadangDipakai;
        }

        // Kirim data ke view dengan nama variabel yang benar
        $data['schedules'] = $jadwals;

        return view('service_schedule', $data);
    }
    
    /**
     * Menampilkan detail satu jadwal servis.
     * Method ini bisa digunakan jika Anda ingin membuat halaman detail untuk setiap jadwal.
     */
    public function show($id)
    {
        $jadwalModel = new ManajemenJadwalModel();
        $jadwal = $jadwalModel->find($id);

        if (!$jadwal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Jadwal dengan ID $id tidak ditemukan.");
        }

        $data['schedule'] = $jadwal;

        // Redirect langsung ke form pembayaran jika diperlukan, atau tampilkan view detail
        // Contoh: return view('service_schedule_detail', $data);
        // Atau langsung ke form pembayaran:
        return redirect()->to('service/payment-form/' . $id);
    }
}