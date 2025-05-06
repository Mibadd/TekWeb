<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan'; // Nama tabel di database
    protected $primaryKey = 'id_kendaraan'; // Nama primary key
    protected $allowedFields = ['nama_kendaraan', 'kategori', 'stok', 'harga']; // Kolom yang bisa diisi
    protected $useTimestamps = true; // Jika ingin menggunakan waktu otomatis
}
