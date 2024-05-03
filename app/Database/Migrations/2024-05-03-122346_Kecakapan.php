<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kecakapan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'warna' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kecakapan');
    }

    public function down()
    {
        $this->forge->dropTable('kecakapan');
    }
}