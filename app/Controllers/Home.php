<?php

namespace App\Controllers;

class Home extends BaseController
{
// app/Controllers/Home.php
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }
        return view('dashboard'); // <-- Masalahnya di sini
    }

    public function jadwalservice()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }
        return view('jadwalservice');
    }

    public function permintaanservice()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }
        return view('permintaanservice');
    }

    public function riwayatperawatan()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }
        return view('riwayatperawatan');
    }
}
