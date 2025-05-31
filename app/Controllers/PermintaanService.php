<?php

namespace App\Controllers;

use App\Models\PermintaanService as PermintaanServiceModel;
use CodeIgniter\Controller;
use App\Models\ServiceScheduleModel;


class PermintaanService extends Controller
{
    public function index()
    {
        // Menampilkan view permintaan service (form)
        return view('permintaanservice');
    }

    public function store()
    {
        $permintaanModel = new PermintaanServiceModel();
        $scheduleModel = new ServiceScheduleModel();

        // Ambil data dari form
        $dataPermintaan = [
            'vehicle'      => $this->request->getPost('vehicle'),
            'service_type' => $this->request->getPost('service_type'),
            'date'         => $this->request->getPost('date'),
            'notes'        => $this->request->getPost('notes'),
        ];

        // Simpan ke permintaan_service dulu
        if ($permintaanModel->insert($dataPermintaan)) {

            // Ambil ID permintaan yang baru saja disimpan
            $permintaanId = $permintaanModel->getInsertID();

            // Buat data untuk jadwal service
            $dataSchedule = [
                // 'user_id' => session()->get('user_id'), // jika ada user login
                'date'         => $dataPermintaan['date'],
                'service_type' => $dataPermintaan['service_type'],
                'status'       => 'Belum Dilaksanakan',
            ];

            // Simpan ke service_schedules
            $scheduleModel->insert($dataSchedule);

            return redirect()->to('/permintaanservice')->with('success', 'Permintaan service dan jadwal berhasil dibuat.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengajukan permintaan service.');
        }
    }


    public function submitRequest()
{
    $serviceScheduleModel = new ServiceScheduleModel();

    $data = [
        'user_id' => session()->get('user_id'),  // jika kamu punya autentikasi
        'service_date' => $this->request->getPost('service_date'),
        'service_type' => $this->request->getPost('service_type'),
        'status' => 'Belum Dilaksanakan',
    ];

    $serviceScheduleModel->insert($data);

    return redirect()->to('/service-schedule')->with('success', 'Permintaan service berhasil dibuat dan masuk ke jadwal.');
}

}
