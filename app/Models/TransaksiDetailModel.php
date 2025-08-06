<?php
namespace App\Models;

use CodeIgniter\Model;

class TransaksiDetailModel extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'transaksi_id',
        'barang_id',
        'qty',
        'harga',
        'subtotal'
    ];
}
