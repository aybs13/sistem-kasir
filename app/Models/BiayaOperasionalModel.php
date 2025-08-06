<?php

namespace App\Models;

use CodeIgniter\Model;

class BiayaOperasionalModel extends Model
{
    protected $table = 'biaya_operasional';
    protected $allowedFields = ['nama', 'jumlah', 'tanggal'];
}
