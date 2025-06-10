<?php

namespace App\Models;

use CodeIgniter\Model;

class ManajemenJadwalModel extends Model
{
    protected $table = 'jadwal_servis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_motor', 'tanggal', 'jam', 'jenis_servis', 'status'];
    protected $useTimestamps = true;
}
