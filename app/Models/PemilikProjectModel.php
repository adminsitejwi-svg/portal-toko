<?php

namespace App\Models;

use CodeIgniter\Model;

class PemilikProjectModel extends Model
{
    protected $table            = 'md_pemilik_projek';
    protected $primaryKey       = 'id';

    protected $allowedFields = [
        'nama_pemilik',
        'alamat_lengkap',
        'pic_projek',
        'nomor_hp_pic',
        'status',
        'keterangan',
        'created_at'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    // Nonaktifkan updated_at
    protected $updatedField  = '';
}
