<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KecakapanModel;
use CodeIgniter\API\ResponseTrait;

class Kecakapan extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new KecakapanModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $model = new KecakapanModel();
        $data = $model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Tidak ada data yang ditemukan dengan id ' . $id);
        }
    }

    public function create()
    {
        $model = new KecakapanModel();
        $data = [
            'nama' => $this->request->getVar('nama'),
            'warna' => $this->request->getVar('warna')
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data kecakapan berhasil ditambahkan'
            ]
        ];
        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $model = new KecakapanModel();
        $data = [
            'nama' => $this->request->getVar('nama'),
            'warna' => $this->request->getVar('warna')
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data kecakapan berhasil diperbarui'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new KecakapanModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data kecakapan berhasil dihapus'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Tidak ada data yang ditemukan dengan id ' . $id);
        }
    }
}