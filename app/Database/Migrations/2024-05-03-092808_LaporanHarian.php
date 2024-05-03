<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanHarian extends Migration
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
            'nama_kegiatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'penanggung_jawab' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'agenda' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'penjelasan' => [
                'type' => 'TEXT',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('laporan_harian');
    }

    public function down()
    {
        $this->forge->dropTable('laporan_harian');
    }
}