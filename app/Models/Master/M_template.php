<?php

namespace App\Models\Master;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_template extends Model
{


    protected $table = 'tblskizin_beta';
    protected $primaryKey = 'tblskizin_id';
    protected $table_view = 'v_template';
    protected $column_order = [];
    protected $column_search = ['tblizin_nama', 'tblizinpermohonan_nama', 'tblskizin_sktemplate', 'tblskizin_tabelsk'];
    protected $order = ['tblskizin_id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;


    protected $allowedFields  = [
        'tblizin_id',
        'tblizinpermohonan_id',
        'tblskizin_sktemplate',
        'tblskizin_tabelvariabel_id'
    ];
    protected $allowedFilter  = [
        'tblizin_id',
        'tblizinpermohonan_id'
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

        $data['tblizin_isaktif'] = 'T';
        return $data;
    }

    public function get_by_id($id)
    {
        $this->dt->where($this->primaryKey, $id);
        return $this->dt->get()->getRowArray();
    }


    public function get_by_id_permohonan($id)
    {
        return $this->where('tblizinpermohonan_id', $id)->first();
    }

    public function get_row_tertentu($t, $id)
    {
        $db = \Config\Database::connect();
        $row = $db->table($t)->where('tblizinpendaftaran_id', $id)->get()->getRowArray();

        if (!$row) {
            return false;
        }

        return $row;
    }


    public function get_row_by_table($table)
    {
        $this->dt->select('tblizin_nama');
        $this->dt->where('tblskizin_tabelsk', $table);
        $r = $this->dt->get()->getRowArray();

        if (!$r) {
            return false;
        }

        return $r['tblizin_nama'];
    }

    public function get_table($id)
    {

        $this->dt->select('tblskizin_tabelsk');
        $this->dt->where('tblizinpermohonan_id', $id);
        $r = $this->dt->get()->getRowArray();

        if (!$r) {
            return false;
        }

        return $r['tblskizin_tabelsk'];
    }




    public function get_table_info($id)
    {
        $table = $this->get_table($id);

        if (!$table) {
            return false;
        }
        $db = \Config\Database::connect();
        $query = $db->table($table)->get();

        $fields = $query->getFieldData();

        return $fields;
    }
}
