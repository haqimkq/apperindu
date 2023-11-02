<?php

namespace App\Models;

use CodeIgniter\Model;

class M_retribusi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tblretribusi';
    protected $primaryKey       = 'tblretribusi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tblizinpendaftaran_id',
        'tblretribusikeringanan_id',
        'tblretribusi_total',
        'tblretribusi_keringanan',
        'tblretribusi_nilai',
        'tblretribusi_tgljadi',
        'tblretribusi_tglbayar',
        'tblretribusi_nomorskrd',
        'tblretribusi_nobuktibayar'

    ];
}
