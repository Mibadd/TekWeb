<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceScheduleModel extends Model
{
    protected $table = 'jadwal_servis';
    protected $primaryKey = 'id';

    // app/Models/ServiceScheduleModel.php
    protected $allowedFields = [
        'jenis_motor',
        'tanggal',
        'jam',
        'jenis_servis',
        'biaya_jasa', // <-- TAMBAHKAN INI
        'status',
        'total_harga'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getLatestSchedulesByUser($userId, $limit = 5)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('date', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
