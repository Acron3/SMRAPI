<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\KecakapanModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class User extends ResourceController
{
    use ResponseTrait;
    // get all user
    public function index()
    {
        $model = new UserModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        foreach ($data as $index => $row){
            $data[$index]['kecakapan'] = $model->getKecakapan($row['id']);
        }
        return $this->respond($data);
    }
    
    // get single user
    public function show($id = null)
    {
        $model = new UserModel();
        $data = $model->find($id);
        $data['kegiatan'] = $model->getKegiatanAktif($data['kegiatan_id']);
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    // create a user
    public function create()
    {
        $model = new UserModel();
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'ktp'                   => 'required',
            'nama'                  => 'required|min_length[3]',
            'ttl'                   => 'required',
            'gender'                => 'required',
            'pendidikan_terakhir'   => 'required',
            'pekerjaan'             => 'required',
            'alamat'                => 'required',
            'no_handphone'          => 'required|min_length[12]|max_length[13]',
            'email'                 => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'password'              => 'required|min_length[6]|max_length[200]',
        ];

        if($this->validate($rules)){
            $data = [
                'ktp'                   => $this->request->getVar('ktp'),
                'nama'                  => $this->request->getVar('nama'),
                'ttl'                   => $this->request->getVar('ttl'),
                'gender'                => $this->request->getVar('gender'),
                'pendidikan_terakhir'   => $this->request->getVar('pendidikan_terakhir'),
                'pekerjaan'             => $this->request->getVar('pekerjaan'),
                'alamat'                => $this->request->getVar('alamat'),
                'telp'                  => $this->request->getVar('no_handphone'),
                'email'                 => $this->request->getVar('email'),
                'password'              => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            
            if($model->insert($data,false)){
                foreach($this->request->getVar('kecakapan') as $kecakapan){
                    $res = $model->addKecakapan($model->getInsertID(), $kecakapan);
                }
                if($res){
                    $response = [
                        'status'   => 201,
                        'error'    => null,
                        'messages' => [
                            'success' => 'Data Created'
                        ]
                    ];
                    return $this->respondCreated($response);
                }
            }else{
                $response = [
                    'status'   => 400,
                    'error'    => 'Error',
                    'messages' => [
                        'error' => 'Data Not Created'
                    ]
                ];
                return $this->respond($response);
            }
        }else{
            return $this->fail($this->validator->getErrors());
        }
    }
 
    // update user
    public function update($id = null)
    {
        $model = new UserModel();
        $data = [
                'nama' => $this->request->getVar('nama'),
                'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
                'ttl' => $this->request->getVar('ttl'),
                'gender' => $this->request->getVar('gender'),
                'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
                'pekerjaan' => $this->request->getVar('pekerjaan'),
                'ktp' => $this->request->getVar('ktp'),
                'alamat' => $this->request->getVar('alamat'),
                'telp' => $this->request->getVar('telp')
            ];

        // Insert to Database
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }
 
    // delete user
    public function delete($id = null)
    {
        $model = new UserModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
             
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    public function registerKegiatan() {
        $id = $this->request->getVar('user_id');
        $kegiatanId = $this->request->getVar('kegiatan_id');
        $model = new UserModel();
        $data = $model->addKegiatan($id,$kegiatanId);
        return $this->respond($data);
    }

    // get users by kegiatan id
    public function tim($id_kegiatan = null)
    {
        $model = new UserModel();
        $data = $model->where('kegiatan_id', $id_kegiatan)->findAll();
        foreach ($data as $index => $row){
            $data[$index]['kecakapan'] = $model->getKecakapan($row['id']);
        }
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with kegiatan_id '.$id_kegiatan);
        }
    }
}