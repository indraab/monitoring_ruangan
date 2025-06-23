<?php

namespace App\Controllers;

use App\Models\RoomUsageModel;

class Monitoring extends BaseController
{
    public function index()
    {
        helper('date');

        // Ambil data ruangan hari ini
        $model = new RoomUsageModel();
        $today = date('Y-m-d');
        $data['usages'] = $model->select('room_usages.*, rooms.room_name AS room')
                            ->join('rooms', 'rooms.id = room_usages.room_name')
                            ->where('date', $today)
                            ->orderBy('start_time', 'ASC')
                            ->findAll();

        // Format hari ke bahasa Indonesia
        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $dayName = $hari[date('l')];
        $formattedDate = $dayName . ', ' . date('d M Y');

        $data['tanggal_hari_ini'] = $formattedDate;

        return view('monitoring/index', $data);
    }
}
