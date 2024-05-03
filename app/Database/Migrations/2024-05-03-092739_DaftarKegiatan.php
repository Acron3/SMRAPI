<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DaftarKegiatan extends Migration
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
            'rab' => [
                'type' => 'DOUBLE',
            ],
            'tgl_mulai' => [
                'type' => 'DATE',
            ],
            'tgl_selesai' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('no', true);
        $this->forge->createTable('daftar_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('daftar_kegiatan');
    }
}