<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Laporan_HarianModel;
 
class Laporan_Harian extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Laporan_HarianModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get single product
    public function show($id = null)
    {
        $model = new Laporan_HarianModel();
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
        $model = new Laporan_HarianModel();
        $data = [
            'id' => $this->request->getVar('id'),
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'lokasi' => $this->request->getVar('lokasi'),
            'penanggung_jawab' => $this->request->getVar('penanggung_jawab'),
            'agenda' => $this->request->getVar('agenda'),
            'penjelasan' => $this->request->getVar('penjelasan')
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
        $model = new Laporan_HarianModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'id' => $json->id,
                'nama_kegiatan' => $json->nama_kegiatan,
                'lokasi' => $json->lokasi,
                'penanggung_jawab' => $json->penanggung_jawab,
                'agenda' => $json->agenda,
                'penjelasan' => $json->penjelasan

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'id' => $input['id'],
                'nama_kegiatan' => $input['nama_kegiatan'],
                'lokasi' => $input['lokasi'],
                'penanggung_jawab' => $input['penanggung_jawab'],
                'agenda' => $input['agenda'],
                'penjelasan' => $input['penjelasan']
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
        $model = new Laporan_HarianModel();
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