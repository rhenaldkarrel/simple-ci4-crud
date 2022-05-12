<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table = 'cabang';
    protected $allowedFields = ['alamat'];

    public function search($keyword)
    {
        return $this->table('cabang')->like('alamat', $keyword);
    }
}
