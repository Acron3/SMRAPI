<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Laporan_KeuanganModel;
 
class Laporan_Keuangan extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Laporan_KeuanganModel();
        $data = $model->orderBy('no', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get single product
    public function show($no = null)
    {
        $model = new Laporan_KeuanganModel();
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
        $model = new Laporan_KeuanganModel();
        $data = [
            'no' => $this->request->getVar('no'),
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'lokasi' => $this->request->getVar('lokasi'),
            'penanggung_jawab' => $this->request->getVar('penanggung_jawab'),
            'agenda' => $this->request->getVar('agenda'),
            'dana_terpakai' => $this->request->getVar('dana_terpakai'),
            'upload_nota' => $this->request->getVar('upload_nota')
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
        $model = new Laporan_KeuanganModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'no' => $json->no,
                'nama_kegiatan' => $json->nama_kegiatan,
                'lokasi' => $json->lokasi,
                'penanggung_jawab' => $json->penanggung_jawab,
                'agenda' => $json->agenda,
                'dana_terpakaii' => $json->dana_terpakai,
                'upload_nota' => $json->upload_nota

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'no' => $input['no'],
                'nama_kegiatan' => $input['nama_kegiatan'],
                'lokasi' => $input['lokasi'],
                'penanggung_jawab' => $input['penanggung_jawab'],
                'agenda' => $input['agenda'],
                'dana_terpakai' => $input['dana_terpakai'],
                'upload_nota' => $input['upload_nota']
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
        $model = new Laporan_KeuanganModel();
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