<?php

namespace App\Models;
use CodeIgniter\Model;

class RoomUsageModel extends Model
{
    protected $table = 'room_usages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pic_name', 'room_name', 'date', 'start_time', 'end_time', 'notes', 'created_by', 'created_at'];

    // ✅ Fungsi untuk ambil jadwal berdasarkan tanggal
    // app/Models/RoomUsageModel.php
public function getUsageByDate($tanggal)
{
return $this->select('room_usages.*, rooms.room_name as room')
                ->join('rooms', 'rooms.id = room_usages.room_name')
                ->where('date', $tanggal)
                ->orderBy('start_time', 'asc')
                ->findAll();
}


    // ✅ Fungsi untuk validasi bentrok waktu
    public function isConflict($data)
{
    $builder = $this->builder();
    $builder->where('date', $data['date']);
    $builder->where('room_name', $data['room_name']);
    $builder->where('id !=', $data['id'] ?? 0); // exclude current id saat edit

    $builder->groupStart()
        ->where('start_time <', $data['end_time'])
        ->where('end_time >', $data['start_time'])
        ->groupEnd();

    return $builder->countAllResults() > 0;
}
}
