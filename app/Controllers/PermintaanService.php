<?php

namespace App\Controllers;

use App\Models\PermintaanServiceModel;
use App\Models\ServiceScheduleModel;

class PermintaanService extends BaseController
{
    protected $permintaanModel;
    protected $scheduleModel;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanServiceModel();
        $this->scheduleModel = new ServiceScheduleModel();
    }

    public function index()
    {
        // Bisa ditambahkan ambil data atau hanya menampilkan form
        return view('permintaanservice');
    }

    public function store()
    {
        // Validasi input sederhana
        if (!$this->validate([
            'vehicle'         => 'required',
            'service_category'=> 'required',
            'service_time'    => 'required',
            'date'            => 'required|valid_date',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid, mohon periksa kembali.');
        }

        // Ambil data input
        $dataPermintaan = [
            'vehicle'          => $this->request->getPost('vehicle'),
            'service_category' => $this->request->getPost('service_category'),
            'service_time'     => $this->request->getPost('service_time'),
            'date'             => $this->request->getPost('date'),
        ];

        // Insert ke tabel permintaan service
        $insertedId = $this->permintaanModel->insert($dataPermintaan);

        if ($insertedId) {
            // Simpan juga ke jadwal service
            $dataSchedule = [
                'permintaan_id' => $insertedId, // Jika ada relasi FK
                // 'user_id' bisa ditambahkan jika pakai session login
                'date'         => $dataPermintaan['date'],
                'service_type' => $dataPermintaan['service_category'],
                'status'       => 'Belum Dilaksanakan',
            ];
            $this->scheduleModel->insert($dataSchedule);

            return redirect()->to('/permintaanservice/detail/' . $insertedId)
                ->with('success', 'Permintaan service dan jadwal berhasil dibuat.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengajukan permintaan service.');
    }

    public function detail($id)
    {
        $serviceData = $this->permintaanModel->find($id);

        if (!$serviceData) {
            return redirect()->to('/permintaanservice')->with('error', 'Data tidak ditemukan');
        }

        return view('detail', ['service' => $serviceData]);
    }
}
