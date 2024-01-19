<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_pemohon extends Model
{
    protected $table = 'tblpemohon';
    protected $table_view = 'v_pemohon';
    protected $primaryKey = 'tblpemohon_id';
    protected $column_order = [];
    protected $column_search = ['tblpemohon_nama', 'tblpemohon_noidentitas', 'tblpemohon_npwp', 'tblpemohon_finger'];
    protected $order = ['tblpemohon_id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;
    protected $allowedFilter  = [];

    protected $allowedFields  = [

        'tblpemohon_nama',
        'tblpemohon_alamat',
        'refjenisidentitas_id',
        'tblpemohon_noidentitas',
        'tblpemohon_npwp',
        'tblpemohon_telpon',
        'tblpemohon_email',
        'tblpemohon_finger',
        'tblpengguna_id',
        'tblpemohon_idonline'
    ];

    public function __construct(RequestInterface $request)
    {
        parent::__construct();

        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table_view);
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
        $this->getDatatablesQuery();

        return $this->dt->countAllResults();
    }

    public function countAll()
    {

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

    public function get_by_pengguna_id($id)
    {
        $this->where('tblpengguna_id', $id);
        return $this->first();
    }
}