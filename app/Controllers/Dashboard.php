<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\BarangModel;
use App\Models\TransaksiDetailModel;
use App\Models\BiayaOperasionalModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $barangModel = new BarangModel();
        $detailModel = new TransaksiDetailModel();
        $biayaModel = new BiayaOperasionalModel();

        $barangExpired = $barangModel->getBarangExpired();

        $hariIni = date('Y-m-d');
        $bulanIni = date('Y-m');

        $penjualanHariIni = $transaksiModel
            ->where('DATE(tanggal)', $hariIni)
            ->selectSum('total')
            ->first()['total'] ?? 0;

        $penjualanBulanIni = $transaksiModel
            ->like('tanggal', $bulanIni, 'after')
            ->selectSum('total')
            ->first()['total'] ?? 0;

        $jumlahTransaksi = $transaksiModel->countAll();
        $stokMenipis = $barangModel->where('stok <= stok_minimal')->countAllResults();

        $barangTerlaris = $detailModel
            ->select('barang_id, SUM(qty) as total_qty')
            ->groupBy('barang_id')
            ->orderBy('total_qty', 'DESC')
            ->limit(1)
            ->first();

        $barang = null;
        if ($barangTerlaris) {
            $barang = $barangModel->find($barangTerlaris['barang_id']);
        }

        // LABA RUGI BULAN INI
        $awalBulan = date('Y-m-01');
        $akhirBulan = date('Y-m-t');

        $transaksiBulanIni = $transaksiModel
            ->where('tanggal >=', $awalBulan)
            ->where('tanggal <=', $akhirBulan)
            ->findAll();

        $total_penjualan_bulan_ini = 0;
        $total_modal_bulan_ini = 0;

        foreach ($transaksiBulanIni as $trx) {
            $total_penjualan_bulan_ini += $trx['total'] ?? 0;

            $details = $detailModel->where('transaksi_id', $trx['id'])->findAll();
            foreach ($details as $d) {
                $barang = $barangModel->find($d['barang_id']);
                $total_modal_bulan_ini += ($barang['harga_beli'] ?? 0) * $d['qty'];
            }
        }

        $total_biaya_operasional = $biayaModel
            ->where('tanggal >=', $awalBulan)
            ->where('tanggal <=', $akhirBulan)
            ->selectSum('jumlah')
            ->first()['jumlah'] ?? 0;

        $laba_bersih_bulan_ini = $total_penjualan_bulan_ini - $total_modal_bulan_ini - $total_biaya_operasional;

        return view('dashboard/index', [
            'hariIni'                   => $penjualanHariIni,
            'bulanIni'                  => $penjualanBulanIni,
            'jumlahTransaksi'          => $jumlahTransaksi,
            'stokMenipis'              => $stokMenipis,
            'barangTerlaris'           => $barang,
            'barangExpired'            => $barangExpired,
            'total_penjualan_bulan_ini'=> $total_penjualan_bulan_ini,
            'total_modal_bulan_ini'    => $total_modal_bulan_ini,
            'total_biaya_operasional'  => $total_biaya_operasional,
            'laba_bersih_bulan_ini'    => $laba_bersih_bulan_ini,
        ]);
    }

        public function statistik()
    {
        $transaksiModel = new TransaksiModel();
        $detailModel = new TransaksiDetailModel();

        // Penjualan 7 hari terakhir
        $weekly = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = date('Y-m-d', strtotime("-$i days"));
            $total = $transaksiModel
                ->where('DATE(tanggal)', $tanggal)
                ->selectSum('total')
                ->first()['total'] ?? 0;
            $weekly[] = ['tanggal' => $tanggal, 'total' => (int) $total];
        }

        // Produk Terlaris Minggu Ini
        $start = date('Y-m-d', strtotime('-7 days'));
        $topProduk = $detailModel
            ->select('barang.nama_barang, SUM(qty) as total_qty')
            ->join('barang', 'barang.id = transaksi_detail.barang_id')
            ->join('transaksi', 'transaksi.id = transaksi_detail.transaksi_id')
            ->where("DATE(transaksi.tanggal) >=", $start)
            ->groupBy('barang_id')
            ->orderBy('total_qty', 'DESC')
            ->limit(5)
            ->findAll();

        return view('dashboard/statistik', compact('weekly', 'topProduk'));
    }
}
