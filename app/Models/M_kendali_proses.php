<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class M_kendali_proses extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tblkendaliproses';
    protected $table_view = 'v_kendali_proses';
    protected $primaryKey       = 'tblkendaliproses_id';
    protected $column_order = [];
    protected $column_search = ['tblizinpendaftaran_nomor', 'tblizinpendaftaran_namapemohon', 'tblizinpendaftaran_usaha'];
    protected $order = ['tblizinpendaftaran_id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;
    protected $allowedFilter  = [
        'tblizin_id',
        'tblizinpermohonan_id',
        'tblkecamatan_id',
        'tblkelurahan_id',
        'tblizinpendaftaran_issign',

    ];

    protected $allowedFields    = [
        'tblizinpendaftaran_id',
        'tblkendalibloksistemtugas_id',
        'tblkendaliproses_tglmulai',
        'tblkendaliproses_tglmulai_sys',
        'tblkendaliproses_tglselesai',
        'tblkendaliproses_tglselesai_sys',
        'tblkendalibloksistem_idasal',
        'tblkendalibloksistem_idkirim',
        'tblkendaliproses_catatan',
        'tblkendaliproses_isparaf',
        'tblkendaliproses_isberkasfisikdikirim',
        'tblkendaliproses_tglberkasfisikdikirim',
        'tblkendaliproses_tglberkasfisikdikirim_sys',
        'tblkendaliproses_tglterima',
        'tblkendaliproses_status',
        'tblpengguna_id',
        'tblkendaliproses_jamlambat',
        'tblkendaliproses_harilambat',
        'tblkendaliproses_jamlambat_sys',
        'tblkendaliproses_harilambat_sys'

    ];


    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt =  $this->db->table($this->table_view);
    }

    private function getDatatablesQuery()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            foreach ($order as $k => $i) {
                $this->dt->orderBy($k, $i);
            }
        }
    }

    public function getDatatables()
    {

        $this->_where();
        if ($this->filter()) {
            $this->dt->where($this->filter());
        }


        $this->getDatatablesQuery();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    public function countFiltered()
    {
        $this->_where();
        if ($this->filter()) {
            $this->dt->where($this->filter());
        }

        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {


        $this->_where();
        if ($this->filter()) {
            $this->dt->where($this->filter());
        }
        return $this->dt->countAllResults();
    }

    public function allowedfields()
    {
        return $this->allowedFields;
    }


    private function filter()
    {
        $data = array();
        foreach ($this->allowedFilter as $key) {

            if ($this->request->getPost($key)) {

                $data[$key] = $this->request->getPost($key);
            }
        }
        return $data;
    }

    private function _where()
    {



        if ($this->request->getPost('str') == 'dikirim') {
            $this->dt->where('tblkendalibloksistem_idkirim', session()->blok_sistem_id);
            $this->dt->where('tblkendaliproses_status', 4);
            // if (session()->blok_sistem_id == 5 || session()->blok_sistem_id == 6 || session()->blok_sistem_id == 7 || session()->blok_sistem_id == 8) {

            //     $arr = $this->get_izin_id();
            //     $this->dt->whereIn('tblizin_id', $arr);
            // }
        }

        if ($this->request->getPost('str') == 'salah_kirim') {
            $this->dt->where('tblkendalibloksistem_idkirim', session()->blok_sistem_id);
            $this->dt->where('tblkendaliproses_status', 4);
            if (session()->blok_sistem_id == 5 || session()->blok_sistem_id == 6 || session()->blok_sistem_id == 7 || session()->blok_sistem_id == 8) {

                $arr = $this->get_izin_id();
                $this->dt->whereNotIn('tblizin_id', $arr);
            }
        }


        if ($this->request->getPost('str') == 'arsip') {
            $this->dt->where('tblkendalibloksistem_idasal', session()->blok_sistem_id);


            // if (session()->blok_sistem_id == 5 || session()->blok_sistem_id == 6 || session()->blok_sistem_id == 7 || session()->blok_sistem_id == 8) {

            //     $arr = $this->get_izin_id();
            //     $this->dt->whereIn('tblizin_id', $arr);
            // }
        }

        if ($this->request->getPost('str') == 'rekap') {
            $this->dt->where('tblkendalibloksistem_idasal', session()->blok_sistem_id);
            $this->dt->where('tblkendaliproses_status', 6);
        }



        if ($this->request->getPost('str') == 'cetak_sk') {
            $this->dt->where('tblkendalibloksistem_idkirim', session()->blok_sistem_id);
            $this->dt->where('tblkendaliproses_status', 4);
            // if (session()->blok_sistem_id == 5 || session()->blok_sistem_id == 6 || session()->blok_sistem_id == 7 || session()->blok_sistem_id == 8) {

            //     $arr = $this->get_izin_id();
            //     $this->dt->whereIn('tblizin_id', $arr);
            // }
        }


        if ($this->request->getPost('str') == 'berkas') {
            $this->dt->where('tblkendalibloksistem_idkirim', session()->blok_sistem_id);
            $this->dt->where('tblkendaliproses_status', 4);
            $this->dt->where('tblizinpendaftaran_issign', 'F');
            $this->dt->where('tblizinpendaftaran_tgljam >=', '2019-01-01 00:00:00');
        }

        if ($this->request->getPost('str') == 'berkas_mandiri') {
            $this->dt->where('tblkendalibloksistem_idkirim', session()->blok_sistem_id);
            $this->dt->where('tblkendaliproses_status', 4);
            $this->dt->where('tblizinpendaftaran_issign', 'F');
            $this->dt->where('tblizin_ismandiri', 'T');
            $this->dt->where('tblizinpendaftaran_tgljam >=', '2019-01-01 00:00:00');
        }


        if ($this->request->getPost('str') == 'sudah') {

            $this->dt->where('tblkendalibloksistem_idkirim', session()->blok_sistem_id);
            $this->dt->where('tblizinpendaftaran_issign', 'T');
            $this->dt->groupBy('tblizinpendaftaran_id');
            // $this->dt->where('tblizin_ismandiri', 'T');
            // $this->dt->where('tblizinpendaftaran_tgljam >=', '2019-01-01 00:00:00');
        }
    }

    private function get_izin_id()
    {
        if (session()->blok_sistem_id == 5) {
            return   ['1', '2', '3', '4', '5', '6', '22', '23', '24', '27', '63', '83', '105', '114'];
        }

        if (session()->blok_sistem_id == 6) {
            return   ['5', '8', '9', '20', '25', '26', '31', '32', '80', '83', '105', '106', '114'];
        }

        if (session()->blok_sistem_id == 7) {
            return   ['7', '10', '18', '19', '28', '29', '30', '33', '16', 79];
        }

        if (session()->blok_sistem_id == 8) {
            return   ['11', '12', '13', '14', '15', '17'];
        }
    }

    public function get_by_id($id)
    {
        $this->dt->where($this->primaryKey, $id);
        return $this->dt->get()->getRowArray();
    }


    public function get_by_id_pendaftaran($id)
    {
        $this->dt->where('tblizinpendaftaran_id', $id);
        $this->dt->orderBy('tblkendaliproses_id', 'DESC');
        return $this->dt->get()->getResultArray();
    }



    public function get_by_status_4($id)
    {

        $this->where('tblizinpendaftaran_id', $id);
        $this->where('tblkendaliproses_status', 4);
        return $this->first();
    }

    public function count_by_id_pendaftaran($id)
    {
        $this->where('tblizinpendaftaran_id', $id);
        return $this->countAllResults();
    }

    public function id_terakhir($id)
    {
        $this->selectMax('tblkendaliproses_id');
        $this->where('tblizinpendaftaran_id', $id);
        return $this->first();
    }
}
