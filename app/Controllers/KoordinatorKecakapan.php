<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KoordinatorKecakapanModel;

class KoordinatorKecakapan extends ResourceController
{
    use ResponseTrait;
    // get all user
    public function index()
    {
        $model = new KoordinatorKecakapanModel();
        $data = $model->orderBy('id', 'DESC')->withKecakapan();
        return $this->respond($data);
    }
    
    // get single user
    public function showByKegiatan($id = null)
    {
        $model = new KoordinatorKecakapanModel();
        $data = $model->where('kegiatan_id', $id)->orWhere('kegiatan_id', null)->findAll();
        return $this->respond($data);
    }
    
    public function show($id = null)
    {
        $model = new KoordinatorKecakapanModel();
        $data = $model->find($id);
        if($data){
            $data['kegiatan'] = $model->getKegiatanAktif($data['kegiatan_id']);
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    // create a user
    public function create()
    {
        $model = new KoordinatorKecakapanModel();
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'ktp'                   => 'required',
            'nama'                  => 'required|min_length[3]',
            'ttl'                   => 'required',
            'gender'                => 'required',
            'jabatan'               => 'required',
            'divisi'                => 'required',
            'alamat'                => 'required',
            'no_handphone'          => 'required|min_length[12]|max_length[13]',
            'email'                 => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'password'              => 'required|min_length[6]|max_length[200]',
            'kecakapan'             => 'required',
        ];

        if($this->validate($rules)){
            $data = [
                'ktp'                   => $this->request->getVar('ktp'),
                'nama'                  => $this->request->getVar('nama'),
                'ttl'                   => $this->request->getVar('ttl'),
                'gender'                => $this->request->getVar('gender'),
                'jabatan'               => $this->request->getVar('jabatan'),
                'divisi'                => $this->request->getVar('divisi'),
                'alamat'                => $this->request->getVar('alamat'),
                'telp'                  => $this->request->getVar('no_handphone'),
                'email'                 => $this->request->getVar('email'),
                'password'              => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'id_kecakapan'          => $this->request->getVar('kecakapan'),
            ];
            
            if($model->insert($data,false)){
                    $response = [
                        'status'   => 201,
                        'error'    => null,
                        'messages' => [
                            'success' => 'Data Created'
                        ]
                    ];
                    return $this->respondCreated($response);
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
        $model = new KoordinatorKecakapanModel();
        $input = $this->request->getVar();
        $data = [];
        foreach ($input as $key => $value) {
            if($key != 'type'){
                if ($key == 'password') {
                    $data[$key] = password_hash($value, PASSWORD_DEFAULT);
                }else {
                    $data[$key] = $value;
                }
            }else{
                $type = $value;
            }
        }
        
        if(isset($type) && $type == 'assign'){
            $model->deleteKegiatan($data['kegiatan_id'],$data['id_kecakapan']);
        }
        
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
        $model = new KoordinatorKecakapanModel();
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
        $model = new KoordinatorKecakapanModel();
        $data = $model->addKegiatan($id,$kegiatanId);
        return $this->respond($data);
    }

    // get users by kegiatan id
    public function tim($kegiatan_id = null)
    {
        $model = new KoordinatorKecakapanModel();
        $data = $model->where('kegiatan_id', $kegiatan_id)->findAll();
        foreach ($data as $index => $row){
            $data[$index]['kecakapan'] = $model->getKecakapan($row['id']);
        }
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with kegiatan_id '.$kegiatan_id);
        }
    }
}