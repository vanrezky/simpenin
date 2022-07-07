<?php

namespace App\Models;

use CodeIgniter\Model;

class KirimDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kirim_detail';
    protected $primaryKey       = 'id_kirim_detail';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kirim', 'id_transaksi_detail', 'qty'];

    // Dates
    protected $useTimestamps = false;
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
