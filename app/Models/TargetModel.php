<?php

namespace App\Models;

use CodeIgniter\Model;

class TargetModel extends Model
{
    
    protected $table            = 'target';
    protected $primaryKey       = 'no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no','nama_target','target_selesai','progress','sisa_hari'];

   
}
