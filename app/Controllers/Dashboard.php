<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login to access the dashboard.');
        }

        return view('dashboard'); // Tampilkan halaman dashboard
    }
}
