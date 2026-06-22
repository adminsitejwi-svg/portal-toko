<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananJwiModel extends Model
{
    protected $table            = 'md_layanan_jwi_group';
    protected $primaryKey       = 'id';

    protected $allowedFields = [
        'nama_layanan',
        'status',
        'keterangan',
        'created_at'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    // Nonaktifkan updated_at
    protected $updatedField  = '';
}
