<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RAB extends Migration
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
            'tanggal' => [
                'type' => 'DATE',
            ],
            'proyek' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'harga' => [
                'type' => 'DOUBLE',
            ],
            'ppn' => [
                'type' => 'DOUBLE',
            ],
            'pajak_lain' => [
                'type' => 'DOUBLE',
            ],
            'total' => [
                'type' => 'DOUBLE',
            ]
        ]);
        $this->forge->addKey('no', true);
        $this->forge->createTable('rab');
    }

    public function down()
    {
        $this->forge->dropTable('rab');
    }
}