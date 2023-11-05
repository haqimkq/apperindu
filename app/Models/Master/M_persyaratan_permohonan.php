<?php

namespace App\Models\Master;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_persyaratan_permohonan extends Model
{
    protected $table = 'tblizinpersyaratan';
    protected $table_view = 'v_izinpersyaratan a';
    protected $primaryKey = 'tblizinpersyaratan_id';
    protected $column_order = [];
    protected $column_search = [];
    protected $order = ['tblizin_id' => 'DESC', 'tblizinpermohonan_id' => 'DESC',  'tblizinpersyaratan_urut' => 'ASC'];
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
        'tblpersyaratan_id',
        'tblizinpersyaratan_urut',
        'tblizinpersyaratan_isaktif'

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

    public function get_persyaratan_by_id_permohonan($id, $id_pendaftaran = null)

    {

        if ($id_pendaftaran) {
            $this->dt->select('a.*, b.tblpemohonpersyaratan_file');
            $this->dt->join('v_persyaratan_pemohon b', 'b.tblpersyaratan_id = a.tblpersyaratan_id AND b.tblizinpendaftaran_id = ' . $id_pendaftaran, 'left');
        }

        $this->dt->where('tblizinpermohonan_id', $id);
        $this->dt->where('tblizinpersyaratan_isaktif', 'T');
        return $this->dt->orderBy('tblizinpersyaratan_urut', 'ASC');
    }
}
