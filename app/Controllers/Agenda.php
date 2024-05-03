<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AgendaModel;
 
class Agenda extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new AgendaModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id = null)
    {
        $model = new  AgendaModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new  AgendaModel();
        $data = [
            'id' => $this->request->getVar('id'),
            'deskripsi' => $this->request->getVar('deskripsi')
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
        $model = new  AgendaModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'id' => $json->id,
                'deskripsi' => $json->deskripsi

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'id' => $input['id'],
                'deskripsi' => $input['deskripsi']
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
        $model = new  AgendaModel();
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
            return $this->failNotFound('No Data Found with no '.$id);
        }
         
    }
    
 
 
}