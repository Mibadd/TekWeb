<?php
namespace App\Models;
use CodeIgniter\Model;

class ServiceScheduleModel extends Model
{
    protected $table = 'jadwal_servis'; // Pastikan nama tabel ini benar
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'jenis_motor', 'tanggal', 'jam',
        'jenis_servis', 'tindakan', 'biaya_jasa',
        'status', 'total_harga'
    ];
    protected $useTimestamps = true;
}