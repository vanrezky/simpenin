<?php

namespace App\Models;

use CodeIgniter\Model;

class GudangModel extends Model
{
    protected $table            = 'gudang';
    protected $primaryKey       = 'id_gudang';
    protected $allowedFields    = ['nama_gudang', 'alamat', 'fasilitas', 'luas', 'deskripsi', 'gambar', 'id_user'];

    // Dates
    protected $useTimestamps = true;
}
