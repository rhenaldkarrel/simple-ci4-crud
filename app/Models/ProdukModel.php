<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'stok'];

    public function search($keyword)
    {
        return $this->table('produk')->like('nama', $keyword);
    }
}
