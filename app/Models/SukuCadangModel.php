<?php

namespace App\Models;

use CodeIgniter\Model;

class SukuCadangModel extends Model
{
    protected $table = 'sukucadang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode', 'nama', 'kategori', 'stok', 'harga', 'status', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;  // otomatis set created_at dan updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
