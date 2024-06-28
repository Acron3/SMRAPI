<?php

namespace App\Models;

use CodeIgniter\Model;

class Daftar_TugasModel extends Model
{
    
    protected $table            = 'daftar_tugas';
    protected $primaryKey       = 'no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_tugas','target_id','status'];

   
}