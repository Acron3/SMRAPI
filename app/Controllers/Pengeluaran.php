<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PengeluaranModel;
 
class Pengeluaran extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new PengeluaranModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id = null)
    {
        $model = new PengeluaranModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with number '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new PengeluaranModel();
        $data = [
            'id' => $this->request->getVar('id'),
            'tanggal_pengeluaran' => $this->request->getVar('tanggal_pengeluaran'),
            'kategori_pengeluaran' => $this->request->getVar('kategori_pengeluaran'),
            'nama_pengeluaran' => $this->request->getVar('nama_pengeluaran'),
            'deskripsi_pengeluaran' => $this->request->getVar('deskripsi_pengeluaran'),
            'nota_pengeluaran' => $this->request->getVar('nota_pengeluaran'),
            'harga_pengeluaran' => $this->request->getVar('harga_pengeluaran'),
            'total_pengeluaran' => $this->request->getVar('total_pengeluaran')
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
        $model = new PengeluaranModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'id' => $json->id,
                'tanggal_pengeluaran' => $json->tanggal_pengeluaran,
                'kategori_pengeluaran' => $json->kategori_pengeluaran,
                'nama_pengeluaran' => $json->nama_pengeluaran,
                'deskripsi_pengeluaran' => $json->deskripsi_pengeluaran,
                'nota_pengeluaran' => $json->nota_pengeluaran,
                'harga_pengeluaran' => $json->harga_pengeluaran,
                'total_pengeluaran' => $json->total_pengeluaran
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'id' => $input['id'],
                'tanggal_pengeluaran' => $input['tanggal_pengeluaran'],
                'kategori_pengeluaran' => $input['kategori_pengeluaran'],
                'nama_pengeluaran' => $input['nama_pengeluaran'],
                'deskripsi_pengeluaran' => $input['deskripsi_pengeluaran'],
                'nota_pengeluaran' => $input['nota_pengeluaran'],
                'harga_pengeluaran' => $input['harga_pengeluaran'],
                'total_pengeluaran' => $input['total_pengeluaran']
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
        $model = new PengeluaranModel();
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
            return $this->failNotFound('No Data Found with number '.$id);
        }
         
    }
    
 
 
}