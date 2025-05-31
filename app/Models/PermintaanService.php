<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanService extends Model
{
    protected $table = 'permintaan_service'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['vehicle', 'service_type', 'date', 'notes']; // Kolom yang dapat diisi
}
