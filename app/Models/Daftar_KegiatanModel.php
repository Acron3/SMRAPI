<?php

namespace App\Models;

use CodeIgniter\Model;

class Daftar_KegiatanModel extends Model
{
    
    protected $table            = 'daftar_kegiatan';
    protected $primaryKey       = 'no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no','nama_kegiatan','lokasi','rab','tgl_mulai','tgl_selesai','status'];

   
}
