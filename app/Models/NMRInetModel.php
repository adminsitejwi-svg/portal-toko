<?php

namespace App\Models;

use App\Models\BaseModel;

class NMRInetModel extends BaseModel
{
    protected $table      = 'd_nomor_inet';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nomor_inet_id',
        'pelanggan_id',
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
