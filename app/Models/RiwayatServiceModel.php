<?php 

namespace App\Models;

use CodeIgniter\Model;

class RiwayatServiceModel extends Model
{
    protected $table = 'riwayat_service';  // Nama tabel
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kendaraan',
        'tanggal_service',
        'jenis_service',
        'tindakan',
        'suku_cadang',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;  // Untuk otomatis mengisi created_at dan updated_at
}
