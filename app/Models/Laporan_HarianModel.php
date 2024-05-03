<?php

namespace App\Models;

use CodeIgniter\Model;

class Laporan_HarianModel extends Model
{
    
    protected $table            = 'laporan_harian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nama_kegiatan','lokasi','penanggung_jawab','agenda','penjelasan'];

   
}
