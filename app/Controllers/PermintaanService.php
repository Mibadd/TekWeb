<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PermintaanService extends BaseController
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login to access this page.');
        }

        // Data permintaan service bisa diambil dari model atau database
        $data = [
            'permintaan' => [
                'Permintaan Service A',
                'Permintaan Service B',
                'Permintaan Service C'
            ]
        ];

        return view('permintaanservice', $data); // Tampilkan halaman permintaan service
    }

    // Method untuk menangani permintaan service baru
    public function create()
    {
        // Ambil data dari form
        $serviceType = $this->request->getPost('service_type');
        $description = $this->request->getPost('description');

        // Simpan permintaan service ke database
        // Misalnya, simpan ke model yang sesuai (Model PermintaanServiceModel)

        // Setelah berhasil, beri pesan sukses dan redirect
        session()->setFlashdata('success', 'Permintaan service berhasil diajukan.');
        return redirect()->to('permintaanservice');
    }
}
