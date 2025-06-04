<?php

namespace App\Models;

use CodeIgniter\Model;

class SukuCadangModel extends Model
{
    protected $table = 'sukucadang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode', 'nama', 'kategori', 'stok', 'harga', 'status'];
    protected $useTimestamps = true;

}
