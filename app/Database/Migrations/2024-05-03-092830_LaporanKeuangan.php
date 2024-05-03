<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanKeuangan extends Migration
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
            'dana_terpakai' => [
                'type' => 'DOUBLE',
            ],
            'upload_nota' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addKey('no', true);
        $this->forge->createTable('laporan_keuangan');
    }

    public function down()
    {
        $this->forge->dropTable('laporan_keuangan');
    }
}