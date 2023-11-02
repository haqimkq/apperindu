<?php

namespace App\Models\Master;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_kendali_alur extends Model
{
    protected $table = 'tblkendalialur';
    protected $table_view = 'v_kendalialur';
    protected $primaryKey = 'tblkendalialur_id';
    protected $column_order = ['tblizin_nama', 'tblizinpermohonan_nama', 'tblkendalibloksistem_nama'];
    protected $column_search =  ['tblizin_nama', 'tblizinpermohonan_nama', 'tblkendalibloksistem_nama'];
    protected $order = ['tblizin_id' => 'DESC', 'tblizinpermohonan_id' => 'DESC', 'tblkendalialur_urut' => 'ASC'];
    protected $request;
    protected $db;
    protected $dt;

    protected $allowedFilter  = [
        'tblizin_id',
        'tblizinpermohonan_id'
    ];

    protected $allowedFields  = [
        'tblizin_id',
        'tblizinpermohonan_id',
        'tblkendalibloksistem_id',
        'tblkendalialur_urut',
        'tblkendalialur_isaktif'

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

    public function get_kendali_alur_by_id_permohonan($id)
    {
        $this->dt->where('tblizinpermohonan_id', $id);
        $this->dt->where('tblkendalialur_isaktif', 'T');
        return $this->dt->orderBy('tblkendalialur_urut', 'ASC');
    }

    public function get_by_permohonan_and_blok_sistem($id)
    {
        $this->where('tblizinpermohonan_id', $id);
        $this->where('tblkendalialur_isaktif', 'T');
        $this->where('tblkendalibloksistem_id', session()->blok_sistem_id);

        return $this->first();
    }

    public function get_by_permohonan_and_no_urut($id, $no)
    {
        $this->where('tblizinpermohonan_id', $id);
        $this->where('tblkendalialur_isaktif', 'T');
        $this->where('tblkendalialur_urut', $no);

        return $this->first();
    }
}
