<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengeluaran extends Migration
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
            'tanggal_pengeluaran' => [
                'type' => 'DATE',
            ],
            'kategori_pengeluaran' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_pengeluaran' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi_pengeluaran' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nota_pengeluaran' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga_pengeluaran' => [
                'type' => 'DOUBLE',
            ],
            'total_pengeluaran' => [
                'type' => 'DOUBLE',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('pengeluaran');
    }
}