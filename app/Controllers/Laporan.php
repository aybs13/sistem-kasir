<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;
use App\Models\BiayaOperasionalModel;

class Laporan extends BaseController
{
    protected $transaksiModel;
    protected $detailModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->detailModel = new TransaksiDetailModel();
    }

    public function index()
    {
        $transaksi = $this->transaksiModel
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('laporan/index', ['transaksi' => $transaksi]);
    }

    public function filter()
    {
        $tanggal_awal = $this->request->getPost('tanggal_awal');
        $tanggal_akhir = $this->request->getPost('tanggal_akhir');

        if (!$tanggal_awal || !$tanggal_akhir) {
            return redirect()->to('/laporan')->with('error', 'Tanggal awal dan akhir wajib diisi!');
        }

        $transaksi = $this->transaksiModel
            ->where('tanggal >=', $tanggal_awal)
            ->where('tanggal <=', $tanggal_akhir)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('laporan/index', [
            'transaksi' => $transaksi,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
        ]);
    }

    public function labaRugi()
    {
        $transaksiModel = new TransaksiModel();
        $detailModel = new TransaksiDetailModel();
        $barangModel = new \App\Models\BarangModel();
        $biayaModel = new BiayaOperasionalModel();

        $awal = $this->request->getGet('awal') ?? date('Y-m-01');
        $akhir = $this->request->getGet('akhir') ?? date('Y-m-d');

        // Ambil semua transaksi dalam rentang waktu
        $transaksi = $transaksiModel
            ->where('tanggal >=', $awal)
            ->where('tanggal <=', $akhir)
            ->findAll();

        $total_penjualan = 0;
        $total_modal = 0;

        foreach ($transaksi as $trx) {
            $total_penjualan += $trx['total'] ?? 0;

            $details = $detailModel->where('transaksi_id', $trx['id'])->findAll();

            foreach ($details as $d) {
                $barang = $barangModel->find($d['barang_id']);
                $harga_beli = $barang['harga_beli'] ?? 0;

                $total_modal += $d['qty'] * $harga_beli;
            }
        }

        // Total biaya operasional
        $sum = $biayaModel
            ->where('tanggal >=', $awal)
            ->where('tanggal <=', $akhir)
            ->selectSum('jumlah')
            ->first();

        $total_biaya = isset($sum['jumlah']) ? $sum['jumlah'] : 0;

        $laba_bersih = $total_penjualan - $total_modal - $total_biaya;

        return view('laporan/laba_rugi', [
            'title' => 'Laporan Laba Rugi',
            'awal' => $awal,
            'akhir' => $akhir,
            'total_penjualan' => $total_penjualan,
            'total_modal' => $total_modal,
            'total_biaya' => $total_biaya,
            'laba_bersih' => $laba_bersih
        ]);
    }



}
