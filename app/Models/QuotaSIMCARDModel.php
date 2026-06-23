<?php

namespace App\Models;

use CodeIgniter\Model;

class QuotaSIMCARDModel extends Model
{
    protected $table            = 'md_quota_simcard';
    protected $primaryKey       = 'id';

    protected $allowedFields = [
        'data_celullar_id',
        'isi_quota_internet',
        'harga_quota_internet',
        'status',
        'keterangan',
        'created_at'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    // Nonaktifkan updated_at
    protected $updatedField  = '';
}
