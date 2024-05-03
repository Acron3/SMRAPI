<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KecakapanUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'kecakapan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kecakapan_id', 'kecakapan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kecakapan_user');
    }

    public function down()
    {
        $this->forge->dropForeignKey('kecakapan_user', 'kecakapan_user_user_id_foreign');
        $this->forge->dropForeignKey('kecakapan_user', 'kecakapan_user_kecakapan_id_foreign');
        $this->forge->dropTable('kecakapan_user');
    }
}