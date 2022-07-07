<?php

namespace App\Models;

use CodeIgniter\Model;

class KirimModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kirim';
    protected $primaryKey       = 'id_kirim';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_transaksi', 'id_user', 'ukuran', 'harga', 'penerima', 'alamat', 'metode_bayar'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
