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
    protected $allowedFields    = ['id','id_kegiatan','deskripsi_laporan','tanggal','status'];

    public function getTugas($id)
    {
        $builder = $this->db->table('laporan_harian_daftar_tugas');
        $builder->join('daftar_tugas', 'daftar_tugas.no = laporan_harian_daftar_tugas.id_daftar_tugas');
        $builder->where('laporan_harian_daftar_tugas.id_laporan_harian', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
   
    public function addTugas($id, $tugasId)
    {
        $builder = $this->db->table('laporan_harian_daftar_tugas');
        $data = [
            'id_laporan_harian' => $id,
            'id_daftar_tugas' => $tugasId
        ];
        return $builder->insert($data);
    }
    
    public function deleteTugas($id)
    {
        $builder = $this->db->table('laporan_harian_daftar_tugas');
        return $builder->where('id_laporan_harian', $id)->delete();
    }

   
}