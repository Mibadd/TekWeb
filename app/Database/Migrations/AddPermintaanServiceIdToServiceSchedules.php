<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPermintaanServiceIdToServiceSchedules extends Migration
{
    public function up()
    {
        $fields = [
            'permintaan_service_id' => [
                'type' => 'INT',
                'null' => true,
                'after' => 'status'  // sesuaikan kolom setelah mana
            ],
        ];
        $this->forge->addColumn('service_schedules', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('service_schedules', 'permintaan_service_id');
    }
}
