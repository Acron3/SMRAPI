<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DaftarTugas extends Migration
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
            'nama_kegiatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'target' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_mulai' => [
                'type' => 'DATE',
            ],
            'deadline' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('no', true);
        $this->forge->createTable('daftar_tugas');
    }

    public function down()
    {
        $this->forge->dropTable('daftar_tugas');
    }
}