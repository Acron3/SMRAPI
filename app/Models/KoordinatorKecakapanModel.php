<?php

namespace App\Models;

use CodeIgniter\Model;

class KoordinatorKecakapanModel extends Model
{
    
    protected $table            = 'koordinator_kecakapan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nama','ttl','gender','jabatan','divisi','ktp','alamat','telp','email', 'password', 'kegiatan_id','id_kecakapan'];
    
    public function getKecakapan($id)
    {
        $builder = $this->db->table($this->table);
        $builder->join('kecakapan', 'kecakapan.id = '.$this->table.'.id_kecakapan');
        $builder->where($this->table.'.id', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function withKecakapan()
    {
        $builder = $this->db->table($this->table);
        $builder->select('koordinator_kecakapan.*, kecakapan.nama as nama_kecakapan, kecakapan.warna as warna_label');
        $builder->join('kecakapan', 'kecakapan.id = '.$this->table.'.id_kecakapan');
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function deleteKegiatan($kegiatan_id,$id_kecakapan)
    {
        $builder = $this->db->table($this->table);
        $builder->where($this->table.'.kegiatan_id', $kegiatan_id);
        $builder->where($this->table.'.id_kecakapan', $id_kecakapan);
        $builder->update(['kegiatan_id'=>null]);
    }
    
    public function getKegiatanAktif($id)
    {
        $builder = $this->db->table('daftar_kegiatan');
        $builder->where('daftar_kegiatan.no',$id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}