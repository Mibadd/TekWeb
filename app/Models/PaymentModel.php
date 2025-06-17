<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
 
    protected $table = 'pembayaran';

    protected $primaryKey = 'id';
<<<<<<< HEAD
    protected $allowedFields = [
        'user_id', 'service_id', 'payment_method', 'payment_proof',
        'payment_status', 'total_amount'
    ];
    protected $useTimestamps = false; // kita atur created_at sendiri

    public function savePayment($data)
    {
        $insertData = [
            'user_id'        => session('user_id'),
            'service_id'     => $data['jadwal_id'],
            'payment_method' => $data['payment_method'],
            'total_amount'   => $data['total_amount'],
            'payment_status' => 'Menunggu Verifikasi',
             // input manual created_at
            // 'payment_proof' => $data['payment_proof'] ?? null, // kalau ada bukti
        ];

        $this->insert($insertData);
        return $this->getInsertID();
    }

    public function getLaporan($start = null, $end = null)
    {
        $builder = $this->db->table('payments p');
        $builder->select('p.created_at AS tanggal, u.nama AS nama_pelanggan, j.jenis_motor AS kendaraan, j.jenis_servis, p.total_amount AS total');
        $builder->join('users u', 'u.id = p.user_id');
        $builder->join('jadwal_servis j', 'j.id = p.service_id'); // ← perbaikan di sini

        if ($start && $end) {
            $builder->where('DATE(p.created_at) >=', $start);
            $builder->where('DATE(p.created_at) <=', $end);
        }

        return $builder->get()->getResultArray();
    }
}
=======

protected $allowedFields = [
    'id_jadwal_servis',
    'user_id', // <-- TAMBAHKAN BARIS INI
    'metode_pembayaran',
    'jumlah_bayar',
    'status_pembayaran',
    'tanggal_bayar',
    'payment_proof'
];
    protected $useTimestamps = false;
}
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
