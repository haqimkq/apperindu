<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_persyaratan_pemohon extends Model
{
    protected $table = 'tblpemohonpersyaratan';
    protected $table_view = 'v_persyaratan_pemohon';
    protected $primaryKey = 'tblpemohonpersyaratan_id';
    protected $request;
    protected $db;
    protected $dt;
    protected $allowedFilter  = [];


    protected $allowedFields  = [
        'tblpemohon_id',
        'tblizinpendaftaran_id',
        'tblpersyaratan_id',
        'tblpemohonpersyaratan_file',
        'tblpemohonpersyaratan_keterangan'
    ];

    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt =  $this->db->table($this->table_view);
    }

    public function get_by_id_pendaftaran($id)
    {
        $this->dt->where('tblizinpendaftaran_id', $id);
        return $this->dt->get()->getResultArray();
    }

    public function get_by_id_pemohon($id)
    {
        $this->dt->where('tblpemohon_id', $id);
        $this->dt->orderBy('tblpersyaratan_id', 'ASC');
        return $this->dt->get()->getResultArray();
    }


    public function get_by_id_pemohon_and_persyaratan($id_pemohon, $id_persyaratan, $id_pendaftaran = null)
    {
        $whr['tblpemohon_id'] = $id_pemohon;
        $whr['tblpersyaratan_id'] = $id_persyaratan;


        if ($id_pendaftaran) {
            $whr['tblizinpendaftaran_id'] = $id_pendaftaran;
            $this->dt->where($whr);
            $row = $this->dt->get()->getRowArray();
            if (!$row) {
                unset($whr['tblizinpendaftaran_id']);
                $this->dt->where($whr);
                $this->dt->orderBy('tblpemohonpersyaratan_id', 'DESC');
                $row = $this->dt->get()->getRowArray();
            }
        } else {
            $this->dt->where($whr);
            $this->dt->orderBy('tblpemohonpersyaratan_id', 'DESC');
            $row = $this->dt->get()->getRowArray();
        }

        return $row;
    }


    public function get_pas_foto($id)
    {
        $this->dt->where('tblpemohon_id', $id);
        $this->dt->like('tblpersyaratan_nama', 'Pas Photo', 'both');
        $this->dt->orderBy('tblpemohonpersyaratan_id', 'DESC');
        return $this->dt->get()->getRowArray();
    }

    public function get_pas_foto_2($id)
    {
        $this->dt->where('tblpemohon_id', $id);
        $this->dt->like('tblpersyaratan_nama', 'Pas Foto', 'both');
        $this->dt->orderBy('tblpemohonpersyaratan_id', 'DESC');
        return $this->dt->get()->getRowArray();
    }

    public function get_persyaratan_pemohon($w)
    {
        $this->dt->where($w);
        return $this->dt->get()->getRowArray();
    }
}
