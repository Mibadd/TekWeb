<?php

namespace App\Models;

use CodeIgniter\Model;

class ManajemenJadwalModel extends Model
{
    protected $table = 'jadwal_servis';
    protected $primaryKey = 'id';
<<<<<<< HEAD
    protected $allowedFields = [
        'jenis_motor',
        'tanggal',
        'jam',
        'jenis_servis',
        'status',
        'biaya_jasa',        // ✅ tambahkan ini
        'total_harga',       // ✅ jika digunakan
    ];
=======
    protected $allowedFields = ['jenis_motor', 'tanggal', 'jam', 'jenis_servis', 'status'];
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
    protected $useTimestamps = true;
}
