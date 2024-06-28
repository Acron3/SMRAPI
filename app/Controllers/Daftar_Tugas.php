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
            'nama_tugas' => $this->request->getVar('nama_tugas'),
            'target_id' => $this->request->getVar('target_id'),
            'status' => $this->request->getVar('status')
        ];
        
        $model->insert($data);
        $data['id_tugas'] = $model->getInsertID();
        $data['no'] = $data['target_id'];
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Penambahan data Sukses!'
            ],
            'data' => $data
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
                'nama_tugas' => $json->nama_tugas,
                'target_id' => $json->target_id,
                'status' => $json->status

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'no' => $input['no'],
                'nama_tugas' => $input['nama_tugas'],
                'target_id' => $input['target_id'],
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