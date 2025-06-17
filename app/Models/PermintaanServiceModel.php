<?php namespace App\Models;

use CodeIgniter\Model;

class PermintaanServiceModel extends Model
{
    protected $table = 'permintaan_service';
    protected $primaryKey = 'id';
    protected $allowedFields = ['vehicle', 'date', 'service_time', 'service_category'];
}
