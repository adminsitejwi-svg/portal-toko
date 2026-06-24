<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSIModel extends Model
{
    protected $table      = 'd_simcard';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'data_cellular_id',
        'quota_simcard_id',
        'pelanggan_id',
        'nomor_msisdn',
        'nomor_issid_ime',
        'id_pelanggan',
        'kode_toko',
        'status',
        'keterangan',
        'created_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}
