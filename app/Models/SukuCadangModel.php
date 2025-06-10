<?php

namespace App\Models;

use CodeIgniter\Model;

class SukuCadangModel extends Model
{
    // Sesuaikan dengan nama tabel Anda
    protected $table = 'sukucadang'; 
    protected $primaryKey = 'id';

    // Sesuaikan dengan kolom-kolom di tabel Anda
    protected $allowedFields = [
        'kode',
        'nama',
        'kategori',
        'stok',
        'harga',
        'status'
    ];

    // Jika Anda menggunakan created_at dan updated_at
    protected $useTimestamps = true;
}