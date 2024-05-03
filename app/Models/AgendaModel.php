<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    
    protected $table            = 'agenda';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','deskripsi'];

   
}
