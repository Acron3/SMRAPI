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
    protected $allowedFields    = ['id','nama','ttl','gender','pendidikan_terakhir','pekerjaan','ktp','alamat','telp','email', 'password'];

   
}