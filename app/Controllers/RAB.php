<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RABModel;
 
class RAB extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new RABModel();
        $data = $model->orderBy('no', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get single product
    public function show($no = null)
    {
        $model = new RABModel();
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
        $model = new RABModel();
        $data = [
            'no' => $this->request->getVar('no'),
            'tanggal' => $this->request->getVar('tanggal'),
            'proyek' => $this->request->getVar('proyek'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'status' => $this->request->getVar('status'),
            'harga' => $this->request->getVar('harga'),
            'ppn' => $this->request->getVar('ppn'),
            'pajak_lain' => $this->request->getVar('pajak_lain'),
            'total' => $this->request->getVar('total')
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
        $model = new RABModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'no' => $json->no,
                'tanggal' => $json->tanggal,
                'proyek' => $json->proyek,
                'deskripsi' => $json->deskripsi,
                'status' => $json->status,
                'harga' => $json->harga,
                'ppn' => $json->ppn,
                'pajak_lain' => $json->pajak_lain,
                'total' => $json->total

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'no' => $input['no'],
                'tanggal' => $input['tanggal'],
                'proyek' => $input['proyek'],
                'deskripsi' => $input['deskripsi'],
                'status' => $input['status'],
                'harga' => $input['harga'],
                'ppn' => $input['ppn'],
                'pajak_lain'  => $input['pajak_lain'],
                'total'  => $input['total']
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
        $model = new RABModel();
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