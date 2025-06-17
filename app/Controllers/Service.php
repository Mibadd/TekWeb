<?php

namespace App\Controllers;
use App\Models\ManajemenJadwalModel;

class Service extends BaseController
{
    public function detailservice()
    {
<<<<<<< HEAD
        $jadwalModel = new \App\Models\ManajemenJadwalModel();

        // Ambil input filter dari query string (GET)
        $vehicle = $this->request->getGet('vehicle');
        $date = $this->request->getGet('date');
        $service_time = $this->request->getGet('service_time');
        $service_category = $this->request->getGet('service_category');

        // Query utama dengan filter lengkap
        $builder = $jadwalModel->builder();
        if ($vehicle) {
            $builder->where('jenis_motor', $vehicle);
        }
        if ($date) {
            $builder->where('tanggal', $date);
        }
        if ($service_time) {
            $builder->where('jam', $service_time);
        }
        if ($service_category && strtolower($service_category) != 'all') {
            $builder->where('jenis_servis', $service_category);
        }
        $jadwals = $builder->get()->getResultArray();
        $jadwalIds = array_column($jadwals, 'id');
        // Query rekomendasi dengan filter longgar: hanya vehicle + date
        $builder2 = $jadwalModel->builder();
        if ($vehicle) {
            $builder2->where('jenis_motor', $vehicle);
        }
        if (!empty($jadwalIds)) {
        $builder2->whereNotIn('id', $jadwalIds); // Hindari duplikasi dari hasil utama
        }
        
        // Jangan filter jam dan kategori di sini supaya rekomendasinya lebih luas
        $rekomendasiJadwals = $builder2->get()->getResultArray();

        $jadwalSukuCadangModel = new \App\Models\JadwalSukuCadangModel();

        // Fungsi helper internal untuk menambahkan data harga dan suku cadang ke tiap jadwal
        $processJadwalList = function (&$list) use ($jadwalSukuCadangModel) {
            foreach ($list as $index => $jadwal) {
                $biayaJasa = is_numeric($jadwal['biaya_jasa']) ? (int)$jadwal['biaya_jasa'] : 0;

                $sukuCadangDipakai = $jadwalSukuCadangModel
                    ->select('sukucadang.id AS sukucadang_id, sukucadang.nama AS nama_sukucadang, sukucadang.harga, jadwal_sukucadang.jumlah')
                    ->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id')
                    ->where('jadwal_sukucadang.jadwal_id', $jadwal['id'])
                    ->findAll();

                $totalSukuCadang = 0;
                $listSukuCadang = [];

                foreach ($sukuCadangDipakai as $item) {
                    $id = $item['sukucadang_id'];
                    $nama = $item['nama_sukucadang'];
                    $harga = (int)$item['harga'];
                    $jumlah = (int)$item['jumlah'];
                    $subtotal = $harga * $jumlah;

                    if (isset($listSukuCadang[$id])) {
                        $listSukuCadang[$id]['jumlah'] += $jumlah;
                        $listSukuCadang[$id]['subtotal'] += $subtotal;
                    } else {
                        $listSukuCadang[$id] = [
                            'nama' => $nama,
                            'harga' => $harga,
                            'jumlah' => $jumlah,
                            'subtotal' => $subtotal
                        ];
                    }

                    $totalSukuCadang += $subtotal;
                }

                $list[$index]['harga_servis'] = $biayaJasa;
                $list[$index]['suku_cadang_dipakai'] = array_values($listSukuCadang);
                $list[$index]['total_suku_cadang'] = $totalSukuCadang;
                $list[$index]['total_harga'] = $totalSukuCadang + $biayaJasa;
            }
        };

        // Proses kedua list agar lengkap datanya
        $processJadwalList($jadwals);
        $processJadwalList($rekomendasiJadwals);

        // Kirim data ke view
        return view('detailservice', [
            'jadwals' => $jadwals,
            'rekomendasiJadwals' => $rekomendasiJadwals,
            'filter' => [
                'vehicle' => $vehicle,
                'date' => $date,
                'service_time' => $service_time,
                'service_category' => $service_category,
            ],
        ]);
    }

    public function paymentForm($id)
{
    $db = \Config\Database::connect();

    // Ambil data jadwal dari tabel yang benar
    $jadwal = $db->table('jadwal_servis')->where('id', $id)->get()->getRowArray();

    if (!$jadwal) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Data jadwal tidak ditemukan");
    }

    // Ambil data suku cadang yang dipakai pada jadwal ini
    $builder = $db->table('jadwal_sukucadang');
    $builder->select('sukucadang.nama, sukucadang.harga, jadwal_sukucadang.jumlah');
    $builder->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id');
    $builder->where('jadwal_sukucadang.jadwal_id', $id);
    $query = $builder->get();

    $jadwal['suku_cadang_dibeli'] = $query->getResultArray();

    return view('payment_form', ['jadwal' => $jadwal]);
}


=======
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
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
}
