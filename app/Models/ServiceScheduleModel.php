<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceScheduleModel extends Model
{
    protected $table = 'service_schedules'; // Nama tabel di DB
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'date',
        'service_type',
        'status',
        'permintaan_service_id', // Kalau ada
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true; // Jika kamu ingin auto timestamp
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
