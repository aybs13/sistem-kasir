<?php

namespace App\Controllers\Api;
use App\Controllers\BaseController;
use App\Models\BarangModel;

class BarangApi extends BaseController
{
    public function cariBarcode()
    {
        $barcode = $this->request->getPost('barcode');
        $barangModel = new BarangModel();

        $barang = $barangModel->where('kode_barcode', $barcode)->first();

        if ($barang) {
            return $this->response->setJSON([
                'status' => true,
                'data' => $barang
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Barang tidak ditemukan'
        ]);
    }
}
