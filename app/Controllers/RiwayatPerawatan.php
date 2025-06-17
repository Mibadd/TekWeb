<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\ManajemenJadwalModel;
use App\Models\JadwalSukuCadangModel;

class RiwayatPerawatan extends BaseController
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        

        $userId = session()->get('user_id');
        $paymentModel = new PaymentModel();
        $jadwalModel = new ManajemenJadwalModel();
        $jadwalSCModel = new JadwalSukuCadangModel();

        $payments = $paymentModel->where('user_id', $userId)
                         ->orderBy('created_at', 'DESC') // DESC = terbaru duluan
                         ->findAll();

        $riwayat = [];

        foreach ($payments as $payment) {
            $service = $jadwalModel->find($payment['service_id']);
            $sukuCadang = $jadwalSCModel->getDetailByJadwal($payment['service_id']);

            $riwayat[] = [
                'created_at' => $service['tanggal'] ?? null,

                'jenis_motor'    => $service['jenis_motor'] ?? '-',
                'jenis_servis'   => $service['jenis_servis'] ?? '-',
                'biaya_jasa'     => $service['biaya_jasa'] ?? 0,
                'suku_cadang'    => $sukuCadang ?? [],
                'total_amount'   => $payment['total_amount'] ?? 0
            ];
        }

        return view('riwayatperawatan', ['riwayat' => $riwayat]);
    }
}
