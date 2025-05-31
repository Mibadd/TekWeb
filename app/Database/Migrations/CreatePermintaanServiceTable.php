<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermintaanServiceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'vehicle' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'service_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('permintaan_service');
    }

    public function down()
    {
        $this->forge->dropTable('permintaan_service');
    }
}
