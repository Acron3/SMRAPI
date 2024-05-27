<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nama','ttl','gender','pendidikan_terakhir','pekerjaan','ktp','alamat','telp','email', 'password', 'kegiatan_id'];
    
    public function getKecakapan($id)
    {
        $builder = $this->db->table('kecakapan_user');
        $builder->join('kecakapan', 'kecakapan.id = kecakapan_user.kecakapan_id');
        $builder->where('kecakapan_user.user_id', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
   
    public function addKecakapan($userId, $kecakapanId)
    {
        $builder = $this->db->table('kecakapan_user');
        $data = [
            'user_id' => $userId,
            'kecakapan_id' => $kecakapanId
        ];
        return $builder->insert($data);
    }
    public function getKegiatan($id)
    {
        $builder = $this->db->table('kegiatan_user');
        $builder->join('daftar_kegiatan', 'daftar_kegiatan.no = kegiatan_user.kegiatan_id');
        $builder->where('kegiatan_user.user_id',$id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function addKegiatan($userId, $kegiatanId)
    {
        $builder = $this->db->table('kegiatan_user');
        $data = [
            'user_id' => $userId,
            'kegiatan_id' => $kegiatanId
        ];
        return $builder->insert($data);
    }
    public function getKegiatanAktif($id)
    {
        $builder = $this->db->table('daftar_kegiatan');
        $builder->where('daftar_kegiatan.no',$id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}