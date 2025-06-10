<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
 
    protected $table = 'pembayaran';

    protected $primaryKey = 'id';

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