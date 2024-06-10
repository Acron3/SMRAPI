<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Daftar_TugasModel;
 
class Daftar_Tugas extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Daftar_TugasModel();
        $data = $model->orderBy('no', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get single product
    public function show($no = null)
    {
        $model = new Daftar_TugasModel();
        $data = $model->where(['no' => $no])->findAll();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with number '.$no);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new Daftar_TugasModel();
        $data = [
            'no' => $this->request->getVar('no'),
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'target' => $this->request->getVar('target'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'deadline' => $this->request->getVar('deadline'),
            'status' => $this->request->getVar('status')
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
    public function update($no = null)
    {
        $model = new Daftar_TugasModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'no' => $json->no,
                'nama_kegiatan' => $json->nama_kegiatan,
                'target' => $json->target,
                'tanggal_mulai' => $json->tanggal_mulai,
                'deadlinei' => $json->deadline,
                'status' => $json->status

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'no' => $input['no'],
                'nama_kegiatan' => $input['nama_kegiatan'],
                'target' => $input['target'],
                'tanggal_mulai' => $input['tanggal_mulai'],
                'deadline' => $input['deadline'],
                'status' => $input['status']
            ];
        }
        // Insert to Database
        $model->update($no, $data);
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
    public function delete($no = null)
    {
        $model = new Daftar_TugasModel();
        $data = $model->find($no);
        if($data){
            $model->delete($no);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
             
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with number '.$no);
        }
         
    }
    
 
 
}