<?php

namespace App\Controllers;

class RiwayatPerawatan extends BaseController
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login to access this page.');
        }

        // Data riwayat perawatan bisa diambil dari model atau database
        $data = [
            'riwayat' => [
                'Service berkala - 20/03/2024',
                'Service CVT - 19/07/2024',
                'Service berkala - 22/09/2024',
            ]
        ];

        return view('riwayatperawatan', $data); // Halaman riwayat perawatan
    }
}
