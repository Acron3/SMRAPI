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
    protected $allowedFields    = ['id','tanggal_pengeluaran','id_kegiatan','qty_pengeluaran','deskripsi_pengeluaran','nota_pengeluaran','harga_pengeluaran','total_pengeluaran'];
    
     public function getMonthlySumByKegiatan($id_kegiatan)
    {
        $builder = $this->db->table($this->table);
        $builder->select("DATE_FORMAT(tanggal_pengeluaran, '%Y-%m-%d') AS tanggal, SUM(total_pengeluaran) AS total_bulanan");
        $builder->where('id_kegiatan', $id_kegiatan);
        $builder->groupBy("tanggal_pengeluaran");
        $query = $builder->get();
        return $query->getResult();
    }
    
     public function getMonthlySum()
    {
        $builder = $this->db->table($this->table);
        $builder->select("DATE_FORMAT(tanggal_pengeluaran, '%Y-%m') AS bulan, SUM(total_pengeluaran) AS total_bulanan");
        $builder->groupBy("tanggal_pengeluaran");
        $query = $builder->get();
        return $query->getResult();
    }
   
}