<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'service_id', 'payment_method', 'payment_proof', 'payment_status', 'total_amount'];
}