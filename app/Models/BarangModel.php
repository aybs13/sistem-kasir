<?php
namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'kode_barcode',
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'stok',
        'stok_minimal',
        'expired_at',
        'modal_per_item' 
    ];

    /**
     * Ambil barang berdasarkan barcode
     */
    public function findByBarcode($barcode)
    {
        return $this->where('kode_barcode', $barcode)->first();
    }

    /**
     * Ambil barang dengan stok di bawah stok minimal
     */
    public function getStokMenipis()
    {
        return $this->where('stok <= stok_minimal')->findAll();
    }

    /**
     * Ambil barang yang akan expired dalam N hari ke depan
     */
    public function getBarangExpired($days = 7)
    {
        $today = date('Y-m-d');
        $limit = date('Y-m-d', strtotime("+$days days"));

        return $this->where('expired_at IS NOT NULL')
                    ->where("expired_at <= '$limit'")
                    ->orderBy('expired_at', 'ASC')
                    ->findAll();
    }
}
