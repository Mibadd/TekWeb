<?php

namespace App\Models; // <-- Pastikan namespace-nya benar

use CodeIgniter\Model;

// Pastikan nama class di bawah ini SAMA PERSIS
class DetailPembelianSukuCadangModel extends Model
{
    protected $table = 'detail_pembelian_sukucadang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_jadwal_servis', 'id_suku_cadang', 'jumlah'];
}