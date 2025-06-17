<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceScheduleModel extends Model
{
<<<<<<< HEAD
    protected $table = 'service_schedules';
    
=======
    protected $table = 'jadwal_servis';
>>>>>>> 33004b58cc8a941cf1233aa7d3325d750b060f59
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
