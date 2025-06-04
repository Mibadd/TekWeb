<?php 

namespace App\Controllers;

use App\Models\RiwayatServiceModel;

class RiwayatService extends BaseController
{
    protected $riwayatServiceModel;

    public function __construct()
    {
        $this->riwayatServiceModel = new RiwayatServiceModel();
    }

    public function index()
    {
        // Ambil semua data dari tabel `riwayat_service`
        $riwayat = $this->riwayatServiceModel->findAll();

        // Kirim data ke view
        return view('riwayatperawatan', ['riwayat' => $riwayat]);
    }
}
