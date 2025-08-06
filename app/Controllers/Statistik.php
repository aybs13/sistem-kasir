<?php
namespace App\Controllers;

use App\Models\TransaksiModel;

class Statistik extends BaseController
{
    public function index()
    {
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');

        $model = new TransaksiModel();
        $data = $model->select("DATE(tanggal) as tgl, SUM(total) as total")
                        ->like('tanggal', $bulan, 'after')
                        ->groupBy('tgl')
                        ->orderBy('tgl', 'ASC')
                        ->findAll();

        return view('statistik/index', [
            'data' => $data,
            'bulan' => $bulan
        ]);
    }
}
