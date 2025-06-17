<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PaymentModel;
use App\Models\ManajemenJadwalModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Pastikan pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login to access the dashboard.');
        }

        // Siapkan model yang akan digunakan
        $userModel = new UserModel();
        $paymentModel = new PaymentModel();
        $jadwalModel = new ManajemenJadwalModel();
        
        $userId = session()->get('user_id');

        // 1. Ambil data pengguna yang sedang login
        $user = $userModel->find($userId);
        
        // Inisialisasi array data untuk dikirim ke view
        $data = [
            'user' => $user,
            'schedules' => [],
            'history' => []
        ];

        // 2. Ambil semua data pembayaran milik pengguna
        $payments = $paymentModel->where('user_id', $userId)
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();

        $upcomingSchedules = [];
        $recentHistory = [];

        // 3. Proses setiap pembayaran untuk memisahkan jadwal mendatang dan riwayat
        if (!empty($payments)) {
            foreach ($payments as $payment) {
                $schedule = $jadwalModel->find($payment['service_id']);

                if ($schedule) {
                    // Cek apakah tanggal servis belum lewat
                    if (strtotime($schedule['tanggal']) >= strtotime(date('Y-m-d'))) {
                        $upcomingSchedules[] = $schedule;
                    } else {
                        // Jika sudah lewat, masukkan ke riwayat
                        $recentHistory[] = $schedule;
                    }
                }
            }
        }
        
        // Batasi hanya 5 data terakhir untuk ditampilkan di dasbor
        $data['schedules'] = array_slice($upcomingSchedules, 0, 5);
        $data['history'] = array_slice($recentHistory, 0, 5);

        // 4. Kirim semua data yang sudah diolah ke view
        return view('dashboard', $data);
    }
}
