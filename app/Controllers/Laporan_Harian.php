<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Laporan_HarianModel;
 
class Laporan_Harian extends ResourceController
{
    use ResponseTrait;
    
    // get all laporan
    public function index()
    {
        $model = new Laporan_HarianModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
 
    // get all laporan by id_kegiatan
    public function show($id_kegiatan = null)
    {
        $model = new Laporan_HarianModel();
        $data = $model->where(['id_kegiatan' => $id_kegiatan])->findAll();
        foreach($data as $index => $row){
            $data[$index]['tugas'] = $model->getTugas($row['id']);
        }
        return $this->respond($data);
    }
 
    // create a laporan
    public function create()
    {
        $model = new Laporan_HarianModel();
        $tugas = explode(',', $this->request->getVar('tugas'));
        $data = [
            'id_kegiatan' => $this->request->getVar('id_kegiatan'),
            'deskripsi_laporan' => $this->request->getVar('deskripsi_laporan'),
            'tanggal' => $this->request->getVar('tanggal')
        ];
        $model->insert($data);
        foreach($tugas as $tugasId){
            $model->addTugas($model->getInsertID(),$tugasId);
        }
        return $this->show($data['id_kegiatan']);
    }
 
    // update laporan
    public function update($id = null)
    {
        $model = new Laporan_HarianModel();
        $model->deleteTugas($id);
        $tugas = explode(',', $this->request->getVar('tugas'));
        $id_kegiatan = $this->request->getVar('id_kegiatan');
        $data = [
            'deskripsi_laporan' => $this->request->getVar('deskripsi_laporan'),
        ];
        $model->update($id, $data);
        foreach($tugas as $tugasId){
            $model->addTugas($id, $tugasId);
        }
        return $this->show($id_kegiatan);
    }
 
    // delete laporan
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
                    'success' => 'Data laporan berhasil dihapus'
                ]
            ];
             
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Tidak ada data ditemukan dengan id '.$id);
        }
         
    }
}