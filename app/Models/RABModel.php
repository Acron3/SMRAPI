<?php

namespace App\Models;

use CodeIgniter\Model;

class RABModel extends Model
{
    
    protected $table            = 'rab';
    protected $primaryKey       = 'no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no','tanggal','proyek','deskripsi','status','harga','ppn','pajak_lain','total'];

   
}