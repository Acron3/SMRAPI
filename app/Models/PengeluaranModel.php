<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    
    protected $table            = 'pengeluaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','tanggal_pengeluaran','kategori_pengeluaran','nama_pengeluaran','deskripsi_pengeluaran','nota_pengeluaran','harga_pengeluaran','total_pengeluaran'];

   
}