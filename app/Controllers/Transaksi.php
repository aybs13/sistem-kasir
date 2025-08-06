<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;

class Transaksi extends BaseController
{
    protected $barangModel;
    protected $transaksiModel;
    protected $detailModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->transaksiModel = new TransaksiModel();
        $this->detailModel = new TransaksiDetailModel();
    }

    public function index()
    {
        return view('transaksi/index');
    }

    public function cari()
    {
        $barcode = trim($this->request->getPost('barcode'));

        // log barcode yg masuk (debugging optional)
        log_message('debug', 'Barcode diterima: ' . $barcode);

        $barang = $this->barangModel
            ->where('kode_barcode', $barcode)
            ->first();

        if ($barang) {
            return $this->response->setJSON($barang);
        }

        return $this->response->setJSON(['status' => false]);
    }


    public function simpan()
    {
        $data = $this->request->getJSON();

        $items = $data->items ?? [];
        $total = $data->total ?? 0;
        $tunai = $data->tunai ?? 0;
        $kembali = $data->kembali ?? 0;

        if ($tunai < $total) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Uang tunai tidak cukup'
            ]);
        }

        // Validasi stok sebelum menyimpan
        foreach ($items as $item) {
            $barang = $this->barangModel->find($item->id);

            if (!$barang) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Barang dengan ID {$item->id} tidak ditemukan."
                ]);
            }

            if ($item->qty > $barang['stok']) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Stok tidak mencukupi untuk {$barang['nama_barang']}. Sisa stok: {$barang['stok']}, diminta: {$item->qty}"
                ]);
            }
        }

        // Simpan transaksi
        $transaksiData = [
            'kode_transaksi' => 'TRX-' . time(),
            'tanggal' => date('Y-m-d H:i:s'),
            'total' => $total,
            'tunai' => $tunai,
            'kembali' => $kembali,
            'user_id' => session('user_id')
        ];

        $this->transaksiModel->insert($transaksiData);
        $transaksiId = $this->transaksiModel->insertID();

        // Simpan detail & update stok
        foreach ($items as $item) {
            $this->detailModel->insert([
                'transaksi_id' => $transaksiId,
                'barang_id' => $item->id,
                'qty' => $item->qty,
                'harga' => $item->harga,
                'subtotal' => $item->subtotal
            ]);

            // Kurangi stok
            $this->barangModel->update($item->id, [
                'stok' => $this->barangModel->find($item->id)['stok'] - $item->qty
            ]);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'id' => $transaksiId
        ]);
    }


    public function nota($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        $detail = $this->detailModel
            ->select('transaksi_detail.*, barang.nama_barang')
            ->join('barang', 'barang.id = transaksi_detail.barang_id')
            ->where('transaksi_id', $id)
            ->findAll();

        $kasir = session('username');

        return view('transaksi/nota', [
            'transaksi' => $transaksi,
            'detail' => $detail,
            'kasir' => $kasir
        ]);
    }

    public function riwayat()
    {
        $transaksi = $this->transaksiModel
            ->select('transaksi.*, users.username')
            ->join('users', 'users.id = transaksi.user_id')
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('transaksi/riwayat', ['transaksi' => $transaksi]);
    }

    public function riwayatDetail($id)
    {
        $transaksi = $this->transaksiModel
            ->select('transaksi.*, users.username')
            ->join('users', 'users.id = transaksi.user_id')
            ->where('transaksi.id', $id)
            ->first();

        $detail = $this->detailModel
            ->select('transaksi_detail.*, barang.nama_barang')
            ->join('barang', 'barang.id = transaksi_detail.barang_id')
            ->where('transaksi_id', $id)
            ->findAll();

        return view('transaksi/riwayat_detail', [
            'transaksi' => $transaksi,
            'detail' => $detail,
        ]);
    }

}
