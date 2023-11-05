<?php

namespace App\Models;

use CodeIgniter\Model;

class M_izinpersyaratanlengkap extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tblizinlengkapisyarat';
    protected $primaryKey       = 'tblizinlengkapisyarat_id ';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tblizinpersyaratan_id', 'tblizinpendaftaran_id'];
}
