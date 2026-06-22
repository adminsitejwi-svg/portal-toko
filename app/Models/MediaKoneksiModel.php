<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaKoneksiModel extends Model
{
    protected $table            = 'md_media_koneksi';
    protected $primaryKey       = 'id';

    protected $allowedFields = [
        'media_koneksi',
        'status',
        'keterangan',
        'created_at'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    // Nonaktifkan updated_at
    protected $updatedField  = '';
}
