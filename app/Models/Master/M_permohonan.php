<?php

namespace App\Models\Master;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_permohonan extends Model
{
    protected $table = 'tblizinpermohonan';
    protected $table_view = 'v_izinpermohonan';
    protected $primaryKey = 'tblizinpermohonan_id';
    protected $column_order = ['tblizinpermohonan_nama'];
    protected $column_search = ['tblizinpermohonan_nama', 'tblizinpermohonan_register', 'tblizin_nama'];
    protected $order = ['tblizinpermohonan_id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    protected $allowedFilter  = [
        'tblizin_id'
    ];

    protected $allowedFields  = [
        'tblizin_id',
        'tblizinpermohonan_nama',
        'tblizinpermohonan_isaktif',
        'tblizinpermohonan_register'
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


    public function get_data()
    {
        return $this->where(['tblizinpermohonan_isaktif' => 'T'])->findAll();
    }

    public function get_permohonan_by_id_izin($id)
    {
        return $this->dt->where('tblizin_id', $id);
    }


    public function get_permohonan_where_not_in($id = null, $id_ex = null)
    {

        if ($id) {
            $this->dt->where('tblizin_id', $id);
        }

        $arr = $this->get_kecuali($id_ex);
        $this->dt->whereNotIn('tblizinpermohonan_id', $arr);

        return $this->dt->get()->getResultArray();
    }


    private function get_kecuali($id = null)
    {
        $db      = \Config\Database::connect();
        $m = $db->table('tblskizin_beta');
        $m->select('tblizinpermohonan_id');

        if ($id) {
            $m->where('tblizinpermohonan_id !=', $id);
        }

        $arr = array();
        $r  = $m->get()->getResultArray();

        foreach ($r as $row) {
            $arr[] = $row['tblizinpermohonan_id'];
        }

        return $arr;
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
}
