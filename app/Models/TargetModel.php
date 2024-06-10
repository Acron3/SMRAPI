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

   public function getTugas($id)
    {
        $builder = $this->db->table('daftar_tugas');
        $builder->select('*, daftar_tugas.no as id_tugas');
        $builder->join('target', 'target.no = daftar_tugas.target_id');
        $builder->where('daftar_tugas.target_id',$id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}