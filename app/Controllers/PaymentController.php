<?php

namespace App\Controllers;

use App\Models\ManajemenJadwalModel;
use App\Models\JadwalSukuCadangModel;
use CodeIgniter\Controller;
use App\Models\PaymentModel;
use Dompdf\Dompdf;

class PaymentController extends Controller
{
    protected $paymentModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel(); // inisialisasi model
    }

    public function list()
{
    $userId = session()->get('user_id');
    $payments = $this->paymentModel->where('user_id', $userId)->findAll();

    return view('payment_form', ['payments' => $payments]);
}


    public function index($jadwalId = null)
    {
        if ($jadwalId === null) {
        return redirect()->to('/payment/list')->with('error', 'Jadwal servis tidak ditemukan.');
        }

        $jadwalModel = new ManajemenJadwalModel();
        $sukuCadangModel = new JadwalSukuCadangModel();
        $db = \Config\Database::connect();

        // Ambil data jadwal servis
        $jadwal = $jadwalModel->find($jadwalId);

        if (!$jadwal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Jadwal tidak ditemukan.");
        }

        // Ambil data suku cadang yang terkait dengan jadwal ini
        $builder = $db->table('jadwal_sukucadang')
            ->select('sukucadang.nama, sukucadang.harga, jadwal_sukucadang.jumlah')
            ->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id')
            ->where('jadwal_sukucadang.jadwal_id', $jadwalId);

        $sukuCadang = $builder->get()->getResultArray();

        // Gabungkan ke dalam array jadwal
        $jadwal['suku_cadang_dibeli'] = $sukuCadang;

        return view('payment_form', ['jadwal' => $jadwal]);
    }

    public function process()
{
    $data = $this->request->getPost();

    // Ambil data jadwal untuk mendapatkan tanggal servis
    $jadwalModel = new \App\Models\ManajemenJadwalModel();
    $jadwal = $jadwalModel->find($data['jadwal_id']);

    if (!$jadwal) {
        return redirect()->back()->with('error', 'Jadwal servis tidak ditemukan.');
    }

    // Gunakan tanggal dari jadwal, atau fallback ke hari ini jika tidak ada
    $tanggal = $jadwal['tanggal'] ?? date('Y-m-d');

    $insertData = [
        'user_id'        => session('user_id'),
        'service_id'     => $data['jadwal_id'],
        'payment_method' => $data['payment_method'],
        'total_amount'   => $data['total_amount'],
        'payment_status' => 'Menunggu Verifikasi',
        
    ];

    $paymentId = $this->paymentModel->insert($insertData);

    return redirect()->to("/payment/history/$paymentId");
}



public function history($id)
{
    $payment = $this->paymentModel->find($id);

    if (!$payment) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Pembayaran tidak ditemukan.");
    }

    // Ambil data servis berdasarkan jadwal_id
    $serviceModel = new \App\Models\ManajemenJadwalModel();
    $service = $serviceModel->find($payment['service_id']); // ← gunakan service_id atau jadwal_id dari payments

    // Ambil data suku cadang yang digunakan pada jadwal tersebut
    $jadwalSCModel = new \App\Models\JadwalSukuCadangModel();
    $sukuCadang = $jadwalSCModel->getDetailByJadwal($payment['service_id']);

    return view('payment_history', [
        'payment' => $payment,
        'service' => $service,
        'suku_cadang' => $sukuCadang
    ]);
}

public function downloadPdf($id)
{
    $payment = $this->paymentModel->find($id);

    if (!$payment) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Pembayaran tidak ditemukan.");
    }

    // Ambil data servis
    $serviceModel = new \App\Models\ManajemenJadwalModel();
    $service = $serviceModel->find($payment['service_id']);

    // Ambil data suku cadang
    $jadwalSCModel = new \App\Models\JadwalSukuCadangModel();
    $sukuCadang = $jadwalSCModel->getDetailByJadwal($payment['service_id']);

    // Buat HTML untuk PDF
    $html = view('payment_pdf', [
        'payment' => $payment,
        'service' => $service,
        'suku_cadang' => $sukuCadang
    ]);

    // Load Dompdf
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("resi-pembayaran-{$id}.pdf", ['Attachment' => false]);
}


}

