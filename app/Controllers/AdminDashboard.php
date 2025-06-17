<?php

    namespace App\Controllers;

    use App\Models\LaporanModel;
    use App\Models\SukuCadangModel; // <--- TAMBAHKAN BARIS INI
    use CodeIgniter\Controller;

    class AdminDashboard extends Controller
    {
        public function index()
        {
            $laporanModel = new LaporanModel();
            $sukuCadangModel = new SukuCadangModel(); // Sekarang class ini akan ditemukan

            $totalServices = $laporanModel->countAllServis();
            $pendingRequests = $laporanModel->countPendingRequestsHariIni();
            $income = $laporanModel->getTotalPendapatan();
            $chartData = $laporanModel->getServisPerBulan();
            $incomeChartData = $laporanModel->getPendapatanPerBulan();
            $sukuCadangMenipis = $sukuCadangModel->getSukuCadangMenipis();

            $data = [
                'totalServices' => $totalServices,
                'pendingRequests' => $pendingRequests,
                'income' => $income,
                'chartData' => $chartData,
                'incomeChartData' => $incomeChartData,
                'stokMenipis' => $sukuCadangMenipis,
                'admin_name' => session()->get('user_name') ?? 'Admin'
            ];

            return view('admin/dashboard', $data);
        }
    }
    