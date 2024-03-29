<?php

namespace App\Models\Master;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_izin extends Model
{
    protected $table = 'tblizin';
    protected $primaryKey = 'tblizin_id';
    protected $column_order = ['tblizin_nama'];
    protected $column_search = ['tblizin_nama'];
    protected $order = ['tblizin_id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;
    protected $allowedFields  = [
        'tblizin_nama',
        'tblizin_isaktif'
    ];

    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
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
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    public function countFiltered()
    {
        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        return $this->dt->countAllResults();
    }

    public function allowedfields()
    {
        return $this->allowedFields;
    }

    public function get_izin_by_blok_sistem()
    {

        $this->dt->where('tblizin_isaktif', 'T');
        if (session()->blok_sistem_id != 99) {
            $query = 'SELECT tblizin_id FROM v_kendali_proses WHERE tblkendalibloksistem_idasal = ' . session()->blok_sistem_id;

            $rows = $this->db->query($query)->getResultArray();
            $id = array();
            foreach ($rows as $r) {
                $id[] = $r['tblizin_id'];
            }

            if (!$id) {
                $id = [0];
            }

            $this->dt->whereIn($this->primaryKey, $id);
        }

        return  $this->dt->get()->getResultArray();
    }




    public function get_data()
    {
        return $this->where(['tblizin_isaktif' => 'T'])->findAll();
    }
}