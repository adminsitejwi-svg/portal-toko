<?php

namespace App\Models;

use CodeIgniter\Model;

class DataCelullarModel extends Model
{
    protected $table            = 'md_data_celullar';
    protected $primaryKey       = 'id';

    protected $allowedFields = [
        'vendor_id',
        'nama_paket_data',
        'status',
        'keterangan',
        'created_at'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    // Nonaktifkan updated_at
    protected $updatedField  = '';
}
