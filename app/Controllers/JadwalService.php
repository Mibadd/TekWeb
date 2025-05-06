<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class JadwalService extends BaseController
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login to access this page.');
        }

        // Data jadwal service bisa diambil dari model atau database
        $data = [
            'jadwal' => [
                '20/03/2024',
                '20/06/2024',
                '22/09/2024',
                '22/12/2024'
            ]
        ];

        return view('jadwalservice', $data); // Tampilkan halaman jadwal service
    }
}
