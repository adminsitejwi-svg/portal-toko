<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPerangkatModel extends Model
{
    protected $table            = 'md_jenis_perangkat';
    protected $primaryKey       = 'id';

    protected $allowedFields = [
        'jenis_perangkat',
        'status',
        'keterangan',
        'created_at'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    // Nonaktifkan updated_at
    protected $updatedField  = '';
}
