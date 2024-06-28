<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PengeluaranModel;
 
class Pengeluaran extends ResourceController
{
    use ResponseTrait;
    
    // get all pengeluaran
    public function index()
    {
        $model = new PengeluaranModel();
        $pengeluaran = $model->getMonthlySum();
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        // Gabungkan atribut dari pemasukan dan pengeluaran berdasarkan bulan dan tahun
        $gabungan = [];
        foreach ($pengeluaran as $item) {
            $tanggal = explode('-', $item->bulan);
            $gabungan[$bulan[$tanggal[1] - 1].' '.$tanggal[0]]['pengeluaran'] = $item->total_bulanan;
        }
        // Ubah format data menjadi array yang diurutkan berdasarkan bulan dan tahun
        $data = [];
        foreach ($gabungan as $tgl => $values) {
            $data[] = [
                'tanggal' => $tgl,
                'pengeluaran' => $values['pengeluaran'] ?? 0
            ];
        }

        // Urutkan data berdasarkan tanggal secara ascending
        usort($data, function($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });
        return $this->respond($data);
    }
 
    // get pengeluaran by id_kegiatan
    public function show($id_kegiatan = null)
    {
        $model = new PengeluaranModel();
        $data = $model->where(['id_kegiatan' => $id_kegiatan])->findAll();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Tidak ada data pengeluaran dengan id_kegiatan '.$id_kegiatan);
        }
    }
 
    // create a pengeluaran
    // Validasi data
    public function create()
    {
        if (!$this->validate([
            'tanggal_pengeluaran' => 'required',
            'id_kegiatan' => 'required',
            'qty_pengeluaran' => 'required|numeric|greater_than_equal_to[0]',
            'deskripsi_pengeluaran' => 'required',
            'harga_pengeluaran' => 'required|numeric|greater_than_equal_to[0]',
            'total_pengeluaran' => 'required|numeric|greater_than_equal_to[0]',
        ])) {
            return $this->fail($this->validator->getErrors());
        }
        
        $model = new PengeluaranModel();
        $nota = $this->request->getFile('nota_pengeluaran');
        $notaName = null;
        if ($nota && !$nota->hasMoved()) {
            if ($nota->getSize() <= 5242880 && in_array($nota->getExtension(), ['jpg', 'png', 'jpeg'])) {
                $notaName = $nota->getRandomName();
                $nota->move(FCPATH . 'nota', $notaName);
            } else {
                return $this->fail('File harus berukuran maksimal 5MB dan berformat jpg, png, atau jpeg.');
            }
        }

        $data = [
            'tanggal_pengeluaran' => $this->request->getVar('tanggal_pengeluaran'),
            'id_kegiatan' => $this->request->getVar('id_kegiatan'),
            'qty_pengeluaran' => $this->request->getVar('qty_pengeluaran'),
            'deskripsi_pengeluaran' => $this->request->getVar('deskripsi_pengeluaran'),
            'nota_pengeluaran' => $notaName,
            'harga_pengeluaran' => $this->request->getVar('harga_pengeluaran'),
            'total_pengeluaran' => $this->request->getVar('total_pengeluaran')
        ];

        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'id'       => $model->getInsertID(),
            'nota'      =>$notaName,
            'messages' => [
                'success' => 'Data pengeluaran berhasil ditambahkan!'
            ]
        ];
         
        return $this->respondCreated($response);
    }
 
    // update pengeluaran
    public function update($id = null)
    {
        // Validasi data
        if (!$this->validate([
            'tanggal_pengeluaran' => 'required',
            'id_kegiatan' => 'required',
            'qty_pengeluaran' => 'required|numeric|greater_than_equal_to[0]',
            'deskripsi_pengeluaran' => 'required',
            'harga_pengeluaran' => 'required|numeric|greater_than_equal_to[0]',
            'total_pengeluaran' => 'required|numeric|greater_than_equal_to[0]',
        ])) {
            return $this->fail($this->validator->getErrors());
        }
        
        $model = new PengeluaranModel();
        $existingData = $model->find($id);
        
        $nota = $this->request->getFile('nota_pengeluaran');
        $notaName = null;
        if ($nota && !$nota->hasMoved()) {
            if ($nota->getSize() <= 5242880 && in_array($nota->getExtension(), ['jpg', 'png', 'jpeg'])) {
                $notaName = $nota->getRandomName();
                $nota->move(FCPATH . 'nota', $notaName);
                if ($existingData && $existingData['nota_pengeluaran'] && $existingData['nota_pengeluaran'] !== $notaName) {
                    @unlink(FCPATH . 'nota/' . $existingData['nota_pengeluaran']);
                }
            } else {
                return $this->fail('File harus berukuran maksimal 5MB dan berformat jpg, png, atau jpeg.');
            }
        } else {
            $notaName = $existingData['nota_pengeluaran'];
        }

        $data = [
            'tanggal_pengeluaran' => $this->request->getVar('tanggal_pengeluaran'),
            'id_kegiatan' => $this->request->getVar('id_kegiatan'),
            'qty_pengeluaran' => $this->request->getVar('qty_pengeluaran'),
            'deskripsi_pengeluaran' => $this->request->getVar('deskripsi_pengeluaran'),
            'nota_pengeluaran' => $notaName,
            'harga_pengeluaran' => $this->request->getVar('harga_pengeluaran'),
            'total_pengeluaran' => $this->request->getVar('total_pengeluaran')
        ];


        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data pengeluaran berhasil diperbarui'
            ]
        ];
        return $this->respond($response);
    }
    // delete pengeluaran
    public function delete($id = null)
    {
        $model = new PengeluaranModel();
        $data = $model->find($id);
        if ($data && $data['nota_pengeluaran']) {
            @unlink(FCPATH . 'nota/' . $data['nota_pengeluaran']);
        }
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data pengeluaran berhasil dihapus'
                ]
            ];
             
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Tidak ada data dengan id '.$id);
        }
         
    }
}