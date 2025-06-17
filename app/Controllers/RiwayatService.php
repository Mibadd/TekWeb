<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\ManajemenJadwalModel;
use App\Models\JadwalSukuCadangModel;

class RiwayatService extends BaseController
{
    public function index()
    {
        // Pastikan pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = session()->get('user_id');
        $paymentModel = new PaymentModel();
        $jadwalModel = new ManajemenJadwalModel();
        $jadwalSCModel = new JadwalSukuCadangModel();

        // 1. Ambil semua data pembayaran milik user yang sedang login, urutkan dari yang terbaru
        $payments = $paymentModel->where('user_id', $userId)
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();

        $riwayat = [];

        // 2. Untuk setiap pembayaran, cari detail servis dan suku cadangnya
        foreach ($payments as $payment) {
            $service = $jadwalModel->find($payment['service_id']);
            $sukuCadang = $jadwalSCModel->getDetailByJadwal($payment['service_id']);

            // 3. Gabungkan semua data menjadi satu array yang rapi
            $riwayat[] = [
                'tanggal_servis' => $service['tanggal'] ?? null, // Ambil tanggal dari jadwal servis
                'jenis_motor'    => $service['jenis_motor'] ?? '-',
                'jenis_servis'   => $service['jenis_servis'] ?? '-',
                'biaya_jasa'     => $service['biaya_jasa'] ?? 0,
                'suku_cadang'    => $sukuCadang ?? [],
                'total_bayar'    => $payment['total_amount'] ?? 0,
                'metode_bayar'   => $payment['payment_method'] ?? '-',
                'id_payment'     => $payment['id']
            ];
        }

        // 4. Kirim data yang sudah lengkap ke view
        return view('riwayatperawatan', ['riwayat' => $riwayat]);
    }
}