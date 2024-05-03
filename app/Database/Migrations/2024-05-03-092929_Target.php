<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Target extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama_target' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'target_selesai' => [
                'type' => 'DATE',
            ],
            'progress' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'sisa_hari' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addKey('no', true);
        $this->forge->createTable('target');
    }

    public function down()
    {
        $this->forge->dropTable('target');
    }
}