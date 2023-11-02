<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengaturan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengaturan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nip_kadis',
        'nik_kadis',
        'nama_kadis',
        'pangkat_kadis',
        'token_wa',
        'token_tte'
    ];


    public function allowedfields()
    {
        return $this->allowedFields;
    }

    public function get_row()
    {
        return $this->where(['status' => 'T'])->first();
    }
}
