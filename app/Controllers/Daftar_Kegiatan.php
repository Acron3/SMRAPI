<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Daftar_KegiatanModel;
use App\Models\Laporan_HarianModel;
use App\Models\PemasukanModel;
use App\Models\PengeluaranModel;
use App\Models\TargetModel;
use App\Models\UserModel;

class Daftar_Kegiatan extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Daftar_KegiatanModel();
        $data = $model->orderBy('no', 'DESC')->findAll();
        foreach ($data as $index => $row){
            $data[$index]['user'] = $model->getUser($row['no']);
            $data[$index]['target'] = $model->getTarget($row['no']);
            $userModel = new UserModel();
            $targetModel = new TargetModel();
            foreach ($data[$index]['user'] as $idx => $user){
                $data[$index]['user'][$idx]['kecakapan'] = $userModel->getKecakapan($user['user_id']);
            }
            foreach ($data[$index]['target'] as $idx => $target){
                $data[$index]['target'][$idx]['tugas'] = $targetModel->getTugas($target['no']);
            }
        }
        return $this->respond($data);
    }
 
    // get single product
    public function show($no = null)
    {
        $model = new Daftar_KegiatanModel();
        $data = $model->getWhere(['no' => $no])->getRow();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$no);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new Daftar_KegiatanModel();
        $data = [
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'lokasi' => $this->request->getVar('lokasi'),
            'rab' => $this->request->getVar('rab'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
            'status' => $this->request->getVar('status')
        ];
        // $data = json_decode(file_get_contents("php://input"));
        //$data = $this->request->getPost();
        $model->insert($data);
        $ketua = $this->request->getVar('ketua');
        $userModel = new UserModel();
        $userModel->update($ketua,['kegiatan_id' => $model->getInsertID(),'role' => 'Ketua']);
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
        $model = new Daftar_KegiatanModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'no' => $json->no,
                'nama_kegiatan' => $json->nama_kegiatan,
                'deskripsi' => $json->deskripsi,
                'lokasi' => $json->lokasi,
                'rab' => $json->rab,
                'tgl_mulai' => $json->tgl_mulai,
                'tgl_selesaii' => $json->tgl_selesai,
                'status' => $json->status

            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'no' => $input['no'],
                'nama_kegiatan' => $input['nama_kegiatan'],
                'deskripsi' => $input['deskripsi'],
                'lokasi' => $input['lokasi'],
                'rab' => $input['rab'],
                'tgl_mulai' => $input['tgl_mulai'],
                'tgl_selesai' => $input['tgl_selesai'],
                'status' => $input['status']
            ];
        }
        // Insert to Database
        
        if($data['status'] == 'Selesai'){
            $model->dispatchUser($no);
            $model->dispatchKoor($no);
        }
        
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
        $model = new Daftar_KegiatanModel();
        $userModel = new UserModel();
        $data = $model->find($no);
        if($data){
            $model->dispatchUser($no);
            $model->dispatchKoor($no);
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
            return $this->failNotFound('No Data Found with no '.$no);
        }
         
    }
        
    public function rab_realisasi($id_kegiatan = null){
        $pemasukanModel = new PemasukanModel();
        $pengeluaranModel = new PengeluaranModel();
        $pemasukan = $pemasukanModel->getMonthlySumByKegiatan($id_kegiatan);
        $pengeluaran = $pengeluaranModel->getMonthlySumByKegiatan($id_kegiatan);

        // Gabungkan atribut dari pemasukan dan pengeluaran berdasarkan bulan dan tahun
        $gabungan = [];
        foreach ($pemasukan as $item) {
            $gabungan[$item->tanggal]['pemasukan'] = $item->jumlah_bulanan;
        }
        foreach ($pengeluaran as $item) {
            $gabungan[$item->tanggal]['pengeluaran'] = $item->total_bulanan;
        }

        // Ubah format data menjadi array yang diurutkan berdasarkan bulan dan tahun
        $data = [];
        foreach ($gabungan as $tgl => $values) {
            $data[] = [
                'tanggal' => $tgl,
                'pemasukan' => $values['pemasukan'] ?? 0,
                'pengeluaran' => $values['pengeluaran'] ?? 0
            ];
        }

        // Urutkan data berdasarkan tanggal secara ascending
        usort($data, function($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });

        return $this->respond($data);
    }
    
    public function validasi($aksi){
        $id_kegiatan = $this->request->getVar('id_kegiatan');
        $id_user = $this->request->getVar('id_user');
        
        $model = new Daftar_KegiatanModel();
        $data = $model->deleteUser($id_kegiatan,$id_user);
        $response=[];
        if($aksi == 'accept'){
            $userModel = new UserModel();
            $updateData = [
                'kegiatan_id' => $id_kegiatan,
                'role' => 'Anggota'
            ];
            if($userModel->update($id_user,$updateData)){
                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' => [
                            'success' => 'User Accepted'
                    ]
                ];
            }else{
                $response = [
                    'status'   => 400,
                    'error'    => null,
                    'messages' => [
                            'success' => 'Error Deleted Data'
                    ]
                ];
            }
        }elseif($aksi == 'reject'){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                        'success' => 'User Rejected'
                ]
            ];
        }else{
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                        'success' => 'Parameter Error'
                ]
            ];
        }
        return $this->respond($response);
    }

    public function validasiLaporan($id){
        $model = new Laporan_HarianModel();
        $model->update($id,['status' => 'valid']);
        $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Laporan Tervalidasi'
                ]
            ];
        return $this->respond($response);
    }
}