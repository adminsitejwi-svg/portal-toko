<?php

namespace App\Models;

use CodeIgniter\Model;

class DCModel extends Model
{
    protected $table = 'md_dc';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_dc',
        'alamat_dc',
        'status',
        'keterangan'
    ];
}
