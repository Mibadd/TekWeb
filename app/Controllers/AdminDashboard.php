<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LaporanModel;
use CodeIgniter\Controller;

class AdminDashboard extends Controller
{
    public function index()
    {
        $laporanModel = new LaporanModel();

        $totalServices = $laporanModel->countAllResults(); // total servis
        $pendingRequests = $laporanModel->where('tanggal', date('Y-m-d'))->countAllResults(); // antrean hari ini
        $income = $laporanModel->getTotalPendapatan(); // total pendapatan, buat method ini di model
        
        $chartData = $laporanModel->getServisPerBulan();

        $data = [
            'totalServices' => $totalServices,
            'pendingRequests' => $pendingRequests,
            'income' => $income,
            'chartData' => $chartData,
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
