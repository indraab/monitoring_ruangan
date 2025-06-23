<?php

namespace App\Controllers;

use App\Models\RoomUsageModel;
use App\Models\RoomModel;
use CodeIgniter\Controller;

class Schedule extends BaseController
{
    protected $model;
    protected $roomModel;

    public function __construct()
    {
        $this->model = new RoomUsageModel();
        $this->roomModel = new RoomModel();
    }

    public function index()
    {
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        return view('admin/schedule', [
            'tanggal' => $tanggal,
            'rooms'   => $this->roomModel->findAll(),
            'usages'  => $this->model->getUsageByDate($tanggal),
        ]);
    }

    public function save()
    {
        $data = $this->request->getPost();

        // Validasi bentrok
        if ($this->model->isConflict($data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan jadwal. Jadwal bentrok dengan agenda lain.'
            ]);
        }

        // Simpan atau update
        if (!empty($data['id'])) {
            $this->model->update($data['id'], $data);
        } else {
            $data['created_by'] = session('username');
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->model->insert($data);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }

    public function get($id)
    {
        return $this->response->setJSON($this->model->find($id));
    }
}
