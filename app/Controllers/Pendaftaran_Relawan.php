<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Pendaftaran_RelawanModel;
 
class Pendaftaran_Relawan extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Pendaftaran_RelawanModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id = null)
    {
        $model = new Pendaftaran_RelawanModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failnotFound('id Data Found with number '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new Pendaftaran_RelawanModel();
        $data = [
            'id' => $this->request->getVar('id'),
            'nama' => $this->request->getVar('nama'),
            'ttl' => $this->request->getVar('ttl'),
            'gender' => $this->request->getVar('gender'),
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'ktp' => $this->request->getVar('ktp'),
            'alamat' => $this->request->getVar('alamat'),
            'telp' => $this->request->getVar('telp'),
            'email' => $this->request->getVar('email'),
            'kecakapan' => $this->request->getVar('kecakapan'),
            'pelatihan' => $this->request->getVar('pelatihan'),
            'penyelenggara' => $this->request->getVar('penyelenggara'),
            'tempat' => $this->request->getVar('tempat'),
            'tahun' => $this->request->getVar('tahun'),
            'bencana' => $this->request->getVar('bencana'),
            'lokasi' => $this->request->getVar('lokasi'),
            'waktu' => $this->request->getVar('waktu'),
        ];
        // $data = json_decode(file_get_contents("php://input"));
        //$data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Penambahan data Sukses!'
            ]
        ];
         
        return $this->respondCreated($response);
    }
 
    // update product
    public function update($id = null)
    {
        $model = new Pendaftaran_RelawanModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'id' => $json->id,
                'nama' => $json->nama,
                'ttl' => $json->ttl,
                'gender' => $json->gender,
                'pendidikan_terakhir' => $json->pendidikan_terakhir,
                'pekerjaan' => $json->pekerjaan,
                'ktp' => $json->ktp,
                'alamat' => $json->alamat,
                'telp' => $json->telp,
                'email' => $json->email,
                'kecakapan' => $json->kecakapan,
                'pelatihan' => $json->pelatihan,
                'penyelenggara' => $json->penyelenggara,
                'tempat' => $json->tempat,
                'tahun' => $json->tahun,
                'bencana' => $json->bencana,
                'lokasi' => $json->lokasi,
                'waktu' => $json->waktu

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'id' => $input['id'],
                'nama' => $input['nama'],
                'ttl' => $input['ttl'],
                'gender' => $input['gender'],
                'pekerjaan' => $input['pekerjaan'],
                'ktp' => $input['ktp'],
                'alamat' => $input['alamat'],
                'telp' => $input['telp'],
                'email' => $input['email'],
                'kecakapan' => $input['kecakapan'],
                'pelatihan' => $input['pelatihan'],
                'penyelenggara' => $input['penyelenggara'],
                'tempat' => $input['tempat'],
                'tahun' => $input['tahun'],
                'bencana' => $input['bencana'],
                'lokasi' => $input['lokasi'],
                'waktu' => $input['waktu']
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
 
    // delete product
    public function delete($id = null)
    {
        $model = new Pendaftaran_RelawanModel();
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
            return $this->failnotFound('id Data Found with number '.$id);
        }
         
    }
    
 
 
}