<?php

namespace App\Controllers;
use App\Models\ManajemenJadwalModel;

class Service extends BaseController
{
    public function detailservice()
    {
        $model = new ManajemenJadwalModel(); // Atau JadwalModel jika kamu pakai itu

        $jenis_motor = $this->request->getGet('vehicle');
        $tanggal = $this->request->getGet('date');
        $jam = $this->request->getGet('service_time');
        $jenis_servis = $this->request->getGet('service_category');

        if ($jenis_motor || $tanggal || $jam || $jenis_servis) {
            // Pakai filter hanya jika ada input dari form
            $model->where('jenis_motor', $jenis_motor)
                ->where('tanggal', $tanggal)
                ->where('jam', $jam)
                ->where('jenis_servis', $jenis_servis);
        }

        $data['jadwals'] = $model->findAll();

        return view('detailservice', $data);
    }

    public function paymentForm($jadwal_id)
    {
        $model = new \App\Models\ManajemenJadwalModel();
        $jadwal = $model->find($jadwal_id);

        if (!$jadwal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Jadwal tidak ditemukan');
        }

        return view('payment_form', ['jadwal' => $jadwal]);
    }
}
