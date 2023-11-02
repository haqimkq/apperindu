<?php

namespace App\Models\Master;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_variabel_sk extends Model
{
    protected $table = 'tblskizin_tabelvariabel';
    protected $primaryKey = 'tblskizin_tabelvariabel_id';
    protected $column_order = [];
    protected $column_search = ['tblskizin_tabelsk'];
    protected $order = ['tblskizin_tabelvariabel_id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;
    protected $allowedFilter  = [];

    protected $allowedFields  = [
        'tblskizin_tabelsk',
    ];

    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt =  $this->db->table($this->table);
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



    public function get_by_id($id)
    {
        $this->dt->where($this->primaryKey, $id);
        return $this->dt->get()->getRowArray();
    }


    public function get_row_variable($id, $kolom)
    {


        $table = $this->get_table_info($id);
        $table_name = $this->get_table($id);

        $arr = array();
        foreach ($table as $row) {

            if ($row->name == $kolom) {
                $arr['table'] = $table_name;
                $arr['nama_kolom'] = $row->name;
                $arr['tipe_data'] = data_type2($row->type_name);

                $panjang = NULL;
                if ($row->type_name != 'date') {
                    // kada tahu jua kenapa di bagi 3
                    $panjang =  $row->length / 3;
                }

                $arr['panjang'] = $panjang;
            }
        }

        return $arr;
    }

    public function get_table($id)
    {

        $this->dt->select('tblskizin_tabelsk');
        $this->dt->where('tblskizin_tabelvariabel_id', $id);
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