<?php

namespace App\Models;

use CodeIgniter\Model;

class KecakapanModel extends Model
{
    protected $table            = 'kecakapan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','warna'];

}