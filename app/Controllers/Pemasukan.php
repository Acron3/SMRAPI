<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PemasukanModel;
 
class Pemasukan extends ResourceController
{
    use ResponseTrait;
    // get all pemasukan
    public function index()
    {
        $model = new PemasukanModel();
        $data = $model->orderBy('no', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get pemasukan by id_kegiatan
    public function show($id_kegiatan = null)
    {
        $model = new PemasukanModel();
        $data = $model->where(['id_kegiatan' => $id_kegiatan])->findAll();
        return $this->respond($data);
        
    }
    
    // get pemasukan by id_kegiatan
    public function getTotal($id_kegiatan = null)
    {
        $model = new PemasukanModel();
        $data = $model->where(['id_kegiatan' => $id_kegiatan])->findAll();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Tidak ada data pemasukan dengan id_kegiatan '.$id_kegiatan);
        }
    }
 
    // create a pemasukan
    public function create()
    {
        $model = new PemasukanModel();
        $data = [
            'tanggal' => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'sumber_dana' => $this->request->getVar('sumber_dana'),
            'jumlah' => $this->request->getVar('jumlah'),
            'id_kegiatan' => $this->request->getVar('id_kegiatan')
        ];

        // Validasi data
        if (!$this->validate([
            'tanggal' => 'required',
            'deskripsi' => 'required',
            'sumber_dana' => 'required',
            'jumlah' => 'required|numeric|greater_than_equal_to[0]',
            'id_kegiatan' => 'required'
        ])) {
            return $this->fail($this->validator->getErrors());
        }

        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data pemasukan berhasil ditambahkan!'
            ]
        ];
         
        return $this->respondCreated($response);
    }
 
    // update pemasukan
    public function update($no = null)
    {
        $model = new PemasukanModel();
        $data = [
            'tanggal' => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'sumber_dana' => $this->request->getVar('sumber_dana'),
            'jumlah' => $this->request->getVar('jumlah'),
            'id_kegiatan' => $this->request->getVar('id_kegiatan')
        ];

        // Validasi data
        if (!$this->validate([
            'tanggal' => 'required',
            'deskripsi' => 'required',
            'sumber_dana' => 'required',
            'jumlah' => 'required|numeric|greater_than_equal_to[0]',
            'id_kegiatan' => 'required'
        ])) {
            return $this->fail($this->validator->getErrors());
        }

        $model->update($no, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data pemasukan berhasil diperbarui'
            ]
        ];
        return $this->respond($response);
    }
 
    // delete pemasukan
    public function delete($no = null)
    {
        $model = new PemasukanModel();
        $data = $model->find($no);
        if($data){
            $model->delete($no);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data pemasukan berhasil dihapus'
                ]
            ];
             
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Tidak ada data dengan nomor '.$no);
        }
         
    }
    
 
 
}