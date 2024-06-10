<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasukanModel extends Model
{
    
    protected $table            = 'pemasukan';
    protected $primaryKey       = 'no';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no','tanggal','deskripsi','sumber_dana','jumlah','id_kegiatan'];

    public function getMonthlySumByKegiatan($id_kegiatan)
    {
        $builder = $this->db->table($this->table);
        $builder->select("DATE_FORMAT(tanggal, '%Y-%m-%d') AS tanggal, SUM(jumlah) AS jumlah_bulanan");
        $builder->where('id_kegiatan', $id_kegiatan);
        $builder->groupBy("tanggal");
        $query = $builder->get();
        return $query->getResult();
    }
   
}