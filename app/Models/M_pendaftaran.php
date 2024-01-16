<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_pendaftaran extends Model
{
    protected $table = 'tblizinpendaftaran';
    protected $table_view = 'v_pendaftaran';
    protected $primaryKey = 'tblizinpendaftaran_id';
    protected $column_order = [];
    protected $column_search = ['tblizinpendaftaran_nomor', 'tblizinpendaftaran_namapemohon', 'tblizinpendaftaran_usaha'];
    protected $order = ['tgl_daftar' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    protected $allowedFilter  = [
        'tblizin_id',
        'tblizinpermohonan_id',
        'tblpemohon_id'
    ];

    protected $allowedFields  = [
        'tblizin_id',
        'tblpemohon_id',
        'tblizinpermohonan_id',
        'tblizinpendaftaran_namapemohon',
        'tblizinpendaftaran_usaha',
        'tblizinpendaftaran_idpemohon',
        'tblizinpendaftaran_npwp',
        'tblizinpendaftaran_almtpemohon',
        'tblizinpendaftaran_telponpemohon',
        'tblizinpendaftaran_lokasiizin',
        'tblkecamatan_id',
        'tblkelurahan_id',
        'tblizinpendaftaran_keterangan',
        'tblizinpendaftaran_nomor',
        'tblizinpendaftaran_tgljam',
        'tblizinpendaftaran_tglbataslambat',
        'tblizinpendaftaran_multi',
        'tblpengguna_id',
        'tblizinpendaftaran_issign',
        'tblizinpendaftaran_tglsign',
        'status_online',
        'sk_dicetak',
        'tblizinpendaftaran_idonline'


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

        if ($this->filter()) {
            $this->dt->where($this->filter());
        }

        $this->dt->where('status_online !=', 1);
        $this->dt->where('status_online !=', 2);

        $this->getDatatablesQuery();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    public function countFiltered()
    {

        if ($this->filter()) {
            $this->dt->where($this->filter());
        }


        $this->dt->where('status_online', 3);
        $this->dt->orWhere('status_online', 4);

        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {



        if ($this->filter()) {
            $this->dt->where($this->filter());
        }

        $this->dt->where('status_online', 3);
        $this->dt->orWhere('status_online', 4);
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



    public function get_nomor_registrasi()
    {
        $tahun =  date('Y');

        $this->select('tblizinpendaftaran_nomor');
        $this->like('tblizinpendaftaran_nomor', $tahun, 'before');
        $this->orderBy('tblizinpendaftaran_tgljam', 'DESC');
        $this->orderBy('tblizinpendaftaran_id', 'DESC');
        $r = $this->limit(1)->first();

        if ($r) {
            $n = explode('/', $r['tblizinpendaftaran_nomor']);
            $n = $n[0] + 1;
            return $n;
        }


        return 1;
    }

    public function get_nomor_registrasi_by_id_izin($id)
    {
        $tahun =  date('Y');

        $this->select('tblizinpendaftaran_nomor');
        $this->where('tblizin_id', $id);
        $this->like('tblizinpendaftaran_nomor', $tahun, 'before');
        $this->orderBy('tblizinpendaftaran_tgljam', 'DESC');
        $this->orderBy('tblizinpendaftaran_id', 'DESC');
        $r = $this->limit(1)->first();

        if ($r) {
            $n = explode('/', $r['tblizinpendaftaran_nomor']);
            $n = $n[1] + 1;
            return $n;
        }


        return 1;
    }

    public function get_by_id($id)
    {
        $this->dt->where('tblizinpendaftaran_id', $id);
        return $this->dt->get()->getRowArray();
    }

    public function get_data($w)
    {
        $this->dt->where($w);
        return $this->dt->get()->getResultArray();
    }


    public function get_num_rows($w)
    {
        $this->dt->where($w);
        return $this->dt->get()->getNumRows();
    }

    public function get_by_pendaftaran_nomor($id)
    {
        $this->dt->where('tblizinpendaftaran_nomor', $id);
        return $this->dt->get()->getRowArray();
    }

    public function get_by_id_pemohon($id)
    {
        $this->dt->where('tblpemohon_id', $id);
        $this->dt->orderBy('tblizinpendaftaran_id', 'DESC');
        return $this->dt->get()->getResultArray();
    }




    public function get_by_id_pemohon_selesai($id)
    {
        $this->dt->where('tblpemohon_id', $id);
        $this->dt->where('tblizinpendaftaran_issign', 'T');
        $this->dt->orderBy('tblizinpendaftaran_id', 'DESC');
        return $this->dt->get()->getResultArray();
    }
}
