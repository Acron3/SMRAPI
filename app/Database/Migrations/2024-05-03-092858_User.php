<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ttl' => [
                'type' => 'DATE',
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'pendidikan_terakhir' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'ktp' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'telp' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}