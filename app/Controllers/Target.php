<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TargetModel;
 
class Target extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new TargetModel();
        $data = $model->orderBy('no', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get single product
    public function show($no = null)
    {
        $model = new TargetModel();
        $data = $model->getWhere(['no' => $no])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with number '.$no);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new TargetModel();
        $data = [
            'no' => $this->request->getVar('no'),
            'nama_target' => $this->request->getVar('nama_target'),
            'target_selesai' => $this->request->getVar('target_selesai'),
            'progress' => $this->request->getVar('progress'),
            'sisa_hari' => $this->request->getVar('sisa_hari')
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
        $model = new TargetModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'no' => $json->no,
                'nama_target' => $json->nama_target,
                'target_selesai' => $json->target_selesai,
                'progress' => $json->progress,
                'sisa_harii' => $json->sisa_hari

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'no' => $input['no'],
                'nama_target' => $input['nama_target'],
                'target_selesai' => $input['target_selesai'],
                'progress' => $input['progress'],
                'sisa_hari' => $input['sisa_hari']
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
        $model = new TargetModel();
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