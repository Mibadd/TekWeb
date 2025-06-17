<?php

namespace App\Controllers;

<<<<<<< HEAD
// Ganti model yang digunakan ke ManajemenJadwalModel
use App\Models\ManajemenJadwalModel; 
use App\Models\JadwalSukuCadangModel;
=======
// Panggil semua model yang akan kita gunakan
use App\Models\ServiceScheduleModel;
use App\Models\DetailPembelianSukuCadangModel;
// Pastikan Anda juga sudah membuat SukuCadangModel jika ada interaksi langsung
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59

class ServiceScheduleController extends BaseController
{
    /**
<<<<<<< HEAD
     * Menampilkan daftar semua jadwal servis yang tersedia untuk pengguna.
     */
    public function index()
    {
        // Gunakan ManajemenJadwalModel untuk mengambil data
        $jadwalModel = new ManajemenJadwalModel();
        $jadwalSukuCadangModel = new JadwalSukuCadangModel();

        // Ambil semua jadwal yang statusnya 'Tersedia' untuk ditampilkan ke user
        $jadwals = $jadwalModel->where('status', 'Tersedia')
                               ->orderBy('tanggal', 'ASC') // Urutkan dari yang paling dekat
                               ->findAll();

        // (Opsional) Jika Anda ingin menampilkan suku cadang di halaman list
        foreach ($jadwals as $key => $jadwal) {
            $sukuCadangDipakai = $jadwalSukuCadangModel
                ->select('sukucadang.nama, jadwal_sukucadang.jumlah, sukucadang.harga')
                ->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id')
                ->where('jadwal_sukucadang.jadwal_id', $jadwal['id'])
                ->findAll();

            $jadwals[$key]['suku_cadang_dipakai'] = $sukuCadangDipakai;
        }

        // Kirim data ke view dengan nama variabel yang benar
        $data['schedules'] = $jadwals;

        return view('service_schedule', $data);
    }
    
    /**
     * Menampilkan detail satu jadwal servis.
     * Method ini bisa digunakan jika Anda ingin membuat halaman detail untuk setiap jadwal.
     */
    public function show($id)
    {
        $jadwalModel = new ManajemenJadwalModel();
        $jadwal = $jadwalModel->find($id);
=======
     * Menampilkan daftar semua jadwal servis beserta suku cadang yang dibeli.
     */
    public function index()
{
    // 1. Panggil semua Model yang kita butuhkan
    $scheduleModel = new \App\Models\ServiceScheduleModel();
    $detailPembelianModel = new \App\Models\DetailPembelianSukuCadangModel();

    // 2. Ambil semua data jadwal utama
    // Variabel $schedules cocok dengan yang Anda gunakan di view
    $schedules = $scheduleModel->orderBy('tanggal', 'DESC')->findAll();

    // 3. Loop setiap jadwal untuk menyuntikkan detail suku cadang
    if (!empty($schedules)) {
        foreach ($schedules as $key => $schedule) {
            
            // Query untuk mengambil data suku cadang yang relevan
            $sukuCadangDibeli = $detailPembelianModel
                ->select('sukucadang.nama, sukucadang.harga, detail_pembelian_sukucadang.jumlah')
                ->join('sukucadang', 'sukucadang.id = detail_pembelian_sukucadang.id_suku_cadang')
                ->where('detail_pembelian_sukucadang.id_jadwal_servis', $schedule['id'])
                ->findAll();
            
            // "Suntikkan" data suku cadang ke dalam array jadwal
            $schedules[$key]['suku_cadang_dibeli'] = $sukuCadangDibeli;
        }
    }

    // 4. Siapkan data untuk dikirim ke view
    $data['schedules'] = $schedules;

    // 5. Tampilkan view 'service_schedule.php' dengan data yang sudah lengkap
    return view('service_schedule', $data); 
}

    /**
     * Menampilkan form untuk membuat permintaan servis baru.
     */
    public function create()
    {
        // Logika ini sudah kita pindahkan ke PermintaanService::index()
        // yang juga mengecek jadwal terisi. Jika ini untuk admin, biarkan saja.
        return view('service_schedule_form');
    }

    /**
     * Menyimpan data permintaan servis baru dari form.
     * Fungsi ini disesuaikan total dengan form permintaan servis dan database Anda.
     */
    public function store()
    {
        $scheduleModel = new ServiceScheduleModel();

        // Pengecekan ketersediaan slot
        $requestedDate = $this->request->getPost('date');
        $requestedTime = $this->request->getPost('service_time');

        if ($scheduleModel->isSlotTaken($requestedDate, $requestedTime)) {
            return redirect()->back()->withInput()->with('error', 'Maaf, jadwal pada tanggal dan jam tersebut sudah terisi.');
        }

        // Validasi input
        $rules = [
            'vehicle'          => 'required',
            'date'             => 'required|valid_date',
            'service_time'     => 'required',
            'service_category' => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan data sesuai struktur tabel 'jadwal_servis'
        $data = [
            'jenis_motor'  => $this->request->getPost('vehicle'),
            'tanggal'      => $this->request->getPost('date'),
            'jam'          => $this->request->getPost('service_time'),
            'jenis_servis' => $this->request->getPost('service_category'),
            'status'       => 'Belum Dilaksanakan',
            'total_harga'  => 0 // Default harga saat pertama kali dibuat
        ];

        // Simpan data dan redirect ke halaman detail
        if ($scheduleModel->save($data)) {
            $newId = $scheduleModel->getInsertID();
            return redirect()->to('/service-schedule/show/' . $newId)
                ->with('success', 'Permintaan servis berhasil dibuat!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan permintaan servis.');
        }
    }
    
    /**
     * Menampilkan detail satu jadwal servis beserta suku cadangnya.
     */
    public function show($id)
    {
        $scheduleModel = new ServiceScheduleModel();
        $detailPembelianModel = new DetailPembelianSukuCadangModel();

        // Ambil data jadwal tunggal
        $schedule = $scheduleModel->find($id);
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59

        if (!$jadwal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Jadwal dengan ID $id tidak ditemukan.");
        }

<<<<<<< HEAD
        $data['schedule'] = $jadwal;

        // Redirect langsung ke form pembayaran jika diperlukan, atau tampilkan view detail
        // Contoh: return view('service_schedule_detail', $data);
        // Atau langsung ke form pembayaran:
        return redirect()->to('service/payment-form/' . $id);
=======
        // Ambil data suku cadang yang terkait dengan jadwal ini
        $sukuCadangDibeli = $detailPembelianModel
            ->select('sukucadang.nama, detail_pembelian_sukucadang.jumlah')
            ->join('sukucadang', 'sukucadang.id = detail_pembelian_sukucadang.id_suku_cadang')
            ->where('detail_pembelian_sukucadang.id_jadwal_servis', $id)
            ->findAll();

        // "Suntikkan" data suku cadang ke dalam data jadwal
        $schedule['suku_cadang_dibeli'] = $sukuCadangDibeli;

        $data['schedule'] = $schedule; // Variabel yang dikirim ke view adalah 'schedule'
        
        return view('service_schedule_detail', $data);
    }

    /**
     * Menghapus jadwal servis beserta detail pembelian suku cadang terkait.
     */
    public function delete($id)
    {
        $scheduleModel = new ServiceScheduleModel();
        $detailPembelianModel = new DetailPembelianSukuCadangModel();
        $db = \Config\Database::connect();

        // Mulai transaksi untuk memastikan semua data terkait terhapus
        $db->transStart();
        
        // 1. Hapus semua data suku cadang yang terkait dengan jadwal ini
        $detailPembelianModel->where('id_jadwal_servis', $id)->delete();
        
        // 2. Hapus data jadwal utamanya
        $scheduleModel->delete($id);

        // Selesaikan transaksi
        $db->transCommit();

        return redirect()->to('/service-schedule')->with('success', 'Jadwal berhasil dihapus.');
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
    }
}