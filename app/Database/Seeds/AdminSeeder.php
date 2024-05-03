<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\AdminModel;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'email' => 'admin@gmail.com',
            'password' => password_hash('1234', PASSWORD_DEFAULT)
        ];

        $adminModel = new AdminModel();
        $adminModel->insert($data);
    }
}