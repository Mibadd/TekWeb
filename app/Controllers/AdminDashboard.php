<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AdminDashboard extends Controller
{
    public function index()
    {
        $userModel = new UserModel();
        $totalUsers = $userModel->countAll(); 
        $totalServices = 1240; 
        $pendingRequests = 34; 
        $income = 8750000;

        $data = [
            'totalUsers' => $totalUsers,
            'totalServices' => $totalServices,
            'pendingRequests' => $pendingRequests,
            'income' => $income,
        ];

        return view('admin/dashboard', $data);
    }

    public function manajemenPengguna()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        $data = [
            'users' => $users
        ];

        return view('admin/manajemenpengguna', $data);
    }
    
    public function datakendaraan()
    {
        return view('admin/datakendaraan'); // Tampilkan hanya view datakendaraan.php
    }

    public function sukucadang()
    {
        return view('admin/sukucadang'); // Tampilkan hanya view sukuCadang.php
    }

    public function statistik()
    {
        return view('admin/statistik'); // Tampilkan hanya view statistik.php
    }
    public function laporan()
    {
        return view('admin/laporan'); // Tampilkan hanya view laporan.php
    }
    public function logaktivitas()
    {
        return view('admin/logaktivitas'); // Tampilkan hanya view logaktivitas.php
    }

}
