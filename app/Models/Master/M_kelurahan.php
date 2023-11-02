<?php

namespace App\Models\Master;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_kelurahan extends Model
{
    protected $table = 'tblkelurahan';
    protected $table_view = 'v_kelurahankecamatan';
    protected $primaryKey = 'tblkelurahan_id';
    protected $column_order = ['tblkecamatan_nama', 'tblkelurahan_nama'];
    protected $column_search =  ['tblkecamatan_nama', 'tblkelurahan_nama'];
    protected $order = ['tblkelurahan_id' => 'DESC', 'tblkecamatan_id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    protected $allowedFilter  = [
        'tblkecamatan_id'
    ];

    protected $allowedFields  = [
        'tblkecamatan_id',
        'tblkelurahan_nama'
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


    public function get_by_id_kecamatan($id)
    {
        return $this->dt->where('tblkecamatan_id', $id);
    }
}
