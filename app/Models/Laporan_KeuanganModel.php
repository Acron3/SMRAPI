<?php

namespace App\Models;

use CodeIgniter\Model;

class Laporan_KeuanganModel extends Model
{
    
    protected $table            = 'laporan_keuangan';
    protected $primaryKey       = 'no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no','nama_kegiatan','lokasi','penanggung_jawab','agenda','dana_terpakai','upload_nota'];

   
}
