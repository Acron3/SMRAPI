<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
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
        return $this->respond($data);
    }
    
    // get single user
    public function show($id = null)
    {
        $model = new UserModel();
        $data = $model->getWhere(['id' => $id])->getResult();
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
            'nama'                  => 'required|min_length[3]',
            'email'                 => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'username'              => 'required|min_length[6]|max_length[50]',
            'no_handphone'          => 'required|min_length[12]|max_length[13]',
            'password'              => 'required|min_length[6]|max_length[200]',
            'ttl'                   => 'required',
            'gender'                => 'required',
            'pendidikan_terakhir'   => 'required',
            'pekerjaan'             => 'required',
            'ktp'                   => 'required',
            'alamat'                => 'required',
            'telp'                  => 'required'
        ];

        if($this->validate($rules)){
            $data = [
                'nama'                  => $this->request->getVar('nama'),
                'username'              => $this->request->getVar('username'),
                'email'                 => $this->request->getVar('email'),
                'no_handphone'          => $this->request->getVar('no_handphone'),
                'password'              => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'ttl'                   => $this->request->getVar('ttl'),
                'gender'                => $this->request->getVar('gender'),
                'pendidikan_terakhir'   => $this->request->getVar('pendidikan_terakhir'),
                'pekerjaan'             => $this->request->getVar('pekerjaan'),
                'ktp'                   => $this->request->getVar('ktp'),
                'alamat'                => $this->request->getVar('alamat'),
                'telp'                  => $this->request->getVar('telp')
            ];
            
            $registered = $model->save($data);
            $this->respondCreated($registered);
        }else{
            return $this->fail($this->validator->getErrors());
        }
    }
 
    // update user
    public function update($id = null)
    {
        $model = new UserModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'nama' => $json->nama,
                'username' => $json->username,
                'email' => $json->email,
                'password' => password_hash($json->password,PASSWORD_DEFAULT),
                'no_handphone' => $json->no_handphone,
                'ttl' => $json->ttl,
                'gender' => $json->gender,
                'pendidikan_terakhir' => $json->pendidikan_terakhir,
                'pekerjaan' => $json->pekerjaan,
                'ktp' => $json->ktp,
                'alamat' => $json->alamat,
                'telp' => $json->telp
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'nama' => $input['nama'],
                'username' => $input['username'],
                'email' => $input['email'],
                'password' => password_hash($input['password'],PASSWORD_DEFAULT),
                'no_handphone' => $input['no_handphone'],
                'ttl' => $input['ttl'],
                'gender' => $input['gender'],
                'pendidikan_terakhir' => $input['pendidikan_terakhir'],
                'pekerjaan' => $input['pekerjaan'],
                'ktp' => $input['ktp'],
                'alamat' => $input['alamat'],
                'telp' => $input['telp']
            ];
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
}