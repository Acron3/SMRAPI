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
    protected $allowedFields    = ['no','nama_kegiatan','lokasi','rab','tgl_mulai','tgl_selesai','status','deskripsi'];

    public function getUser($id)
    {
        $builder = $this->db->table('kegiatan_user');
        $builder->join('user', 'user.id = kegiatan_user.user_id');
        $builder->where('kegiatan_user.kegiatan_id',$id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function getTarget($id)
    {
        $builder = $this->db->table('target');
        $builder->where('target.kegiatan_id',$id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function deleteUser($id,$userId)
    {
        $builder = $this->db->table('kegiatan_user');
        $builder->where('kegiatan_user.kegiatan_id',$id);
        $builder->where('kegiatan_user.user_id',$userId);
        $query = $builder->delete();
        return $query;
    }
    
    public function clearKegiatanUser($userId)
    {
        $builder = $this->db->table('kegiatan_user');
        $builder->where('kegiatan_user.user_id',$userId);
        $query = $builder->delete();
        return $query;
    }
    
    public function dispatchUser($id)
    {
        $builder = $this->db->table('user');
        $builder->where('kegiatan_id',$id);
        $builder->update(['kegiatan_id' => null,'role' => '-']);
    }
    
    public function dispatchKoor($id)
    {
        $builder = $this->db->table('koordinator_kecakapan');
        $builder->where('kegiatan_id',$id);
        $builder->update(['kegiatan_id' => null]);
    }

}