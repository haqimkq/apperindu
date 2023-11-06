<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\M_template;
use App\Models\Master\M_variabel_sk;
use Config\Services;


class Variabel_sk extends BaseController
{
    private $page = 'Tabel / Variabel';
    private $url = 'variabel_sk';
    private $path = 'Master/variabel_sk';

    protected $model;
    protected $model_template;
    protected $request;
    protected $primaryKey = 'tblskizin_tabelvariabel_id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_variabel_sk($this->request);
        $this->model_template = new M_template($this->request);
    }

    public function index()
    {

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;

        return view($this->path . '/view', $data);
    }

    public function get_data()
    {


        $lists = $this->model->getDatatables();
        $data = [];
        $no = $this->request->getPost('start');

        foreach ($lists as $l) {
            $no++;
            $row = [];
            $row[] = $no . '.';
            $row[] = '<div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="info(\'' . $l[$this->primaryKey] . '\')">Detail tabel</a>
                </li>
                <li><a class="dropdown-item" href="#" onclick="update(\'' . $l[$this->primaryKey] . '\',\'' . $l['tblskizin_tabelsk'] . '\',\'' . $l['tblskizin_tabelvariabel_isrekom'] . '\')">Edit tabel</a>
                </li>
                <li><a class="dropdown-item" href="#" onclick="hapus(\'' . $l[$this->primaryKey] . '\',\'' . $l['tblskizin_tabelsk'] . '\')">Hapus tabel</a>
                </li>
            </ul>
            </div>';

            $row[] = '<div class="text-wrap">' . $l['tblskizin_tabelsk'] . '</div>';
            $row[] = is_rekom($l['tblskizin_tabelvariabel_isrekom']);
            $data[] = $row;
        }

        $output = [
            'draw' => $this->request->getPost('draw'),
            'recordsTotal' => $this->model->countAll(),
            'recordsFiltered' => $this->model->countFiltered(),
            'data' => $data
        ];

        echo json_encode($output);
    }

    private function terpakai($table)
    {
        $r = $this->model_template->get_row_by_table($table);

        if (!$r) {
            return 'Tidak terpakai';
        }

        return 'Terpakai';
    }

    private function terpakai_untuk($table)
    {
        $r = $this->model_template->get_row_by_table($table);

        if (!$r) {
            return '';
        }

        return $r;
    }

    public function form_page()
    {

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;

        return view($this->path . '/table/form_page', $data);
    }


    public function form()
    {

        $rules = [
            'nama_tabel' => 'required',
            'tblskizin_tabelvariabel_isrekom' => 'required'
        ];

        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => 'Form tidak lengkap');
            return $this->response->setJSON($res);
        }


        $nama_tabel = $this->request->getPost('nama_tabel');
        $nama_kolom = $this->request->getPost('nama_kolom');
        $tipe_data = $this->request->getPost('tipe_data');
        $panjang = $this->request->getPost('panjang');

        $sqlQuery = "CREATE TABLE $nama_tabel (";
        $sqlQuery .= $nama_tabel . '_id INT(10) PRIMARY KEY AUTO_INCREMENT, ';
        $sqlQuery .= "tblizinpendaftaran_id INT(11), ";
        $sqlQuery .= "no_izin VARCHAR(225), ";
        $sqlQuery .= "tgl_penetapan date, ";
        $sqlQuery .= "berlaku_sampai date, ";
        foreach ($nama_kolom as $key => $val) {

            if (!$panjang[$key]) {
                $panjang[$key] = '225';
            }

            $p = '';

            if ($tipe_data[$key] !== 'date') {
                $p = '(' . $panjang[$key] . ')';
            }

            // Tambahkan kolom ke query
            $sqlQuery .= "$val $tipe_data[$key]$p, ";
        }



        $sqlQuery = rtrim($sqlQuery, ", "); // Hapus koma ekstra di akhir query

        $sqlQuery .= ")";

        $db = \Config\Database::connect();
        $db->query($sqlQuery);
        $db->transStart();

        // Lakukan perubahan skema di sini

        $db->transComplete();

        if ($db->transStatus() === false) {
            // Jika transaksi gagal
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        $d['tblskizin_tabelsk'] = $nama_tabel;
        $d['tblskizin_tabelvariabel_isrekom'] = $this->request->getPost('tblskizin_tabelvariabel_isrekom');
        $in = $this->model->save($d);

        if (!$in) {
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        $res = array('status' => true, 'msg' => success_add());
        return $this->response->setJSON($res);
    }



    public function form_update()
    {

        $rules = [
            'id' => 'required',
            'table_lama' => 'required',
            'table' => 'required',

        ];

        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => 'Form tidak lengkap');
            return $this->response->setJSON($res);
        }

        $id = $this->request->getPost('id');
        $table = $this->request->getPost('table');
        $table_lama = $this->request->getPost('table_lama');

        if ($table != $table_lama) {
            $sqlQuery = "RENAME TABLE $table_lama TO $table";

            $db = \Config\Database::connect();
            $db->query($sqlQuery);
            $db->transStart();

            // Lakukan perubahan skema di sini

            $db->transComplete();

            if ($db->transStatus() === false) {
                // Jika transaksi gagal
                $res = array('status' => false, 'msg' => failed());
                return $this->response->setJSON($res);
            }
        }


        $d['tblskizin_tabelsk'] = $table;
        $d['tblskizin_tabelvariabel_isrekom'] = $this->request->getPost('tblskizin_tabelvariabel_isrekom');
        $u =  $this->model->update($id, $d);

        if ($u) {
            $res = array('status' => true, 'msg' => success_update());
            return $this->response->setJSON($res);
        }


        $res = array('status' => false, 'msg' => failed());
        return $this->response->setJSON($res);
    }

    public function form_add_kolom()
    {

        $rules = [
            'nama_kolom' => 'required',
            'tipe_data' => 'required',
            'table' => 'required',
        ];

        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => 'Form tidak lengkap');
            return $this->response->setJSON($res);
        }

        $id = $this->request->getPost('id');
        $table = $this->request->getPost('table');
        $nama_kolom = $this->request->getPost('nama_kolom');
        $tipe_data = $this->request->getPost('tipe_data');
        $panjang = $this->request->getPost('panjang');

        if (!$panjang) {
            $panjang = '225';
        }

        if ($tipe_data != 'date') {
            $tipe_data = "$tipe_data($panjang)";
        }

        $sqlQuery = "ALTER TABLE $table ADD $nama_kolom $tipe_data";

        $db = \Config\Database::connect();
        $db->query($sqlQuery);
        $db->transStart();

        // Lakukan perubahan skema di sini

        $db->transComplete();

        if ($db->transStatus() === false) {
            // Jika transaksi gagal
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }


        $res = array('status' => true, 'msg' => success_add(), 'id' => $id);
        return $this->response->setJSON($res);
    }

    public function form_update_kolom()
    {

        $rules = [
            'nama_kolom' => 'required',
            'nama_kolom_lama' => 'required',
            'tipe_data' => 'required',
            'table' => 'required',
        ];

        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => 'Form tidak lengkap');
            return $this->response->setJSON($res);
        }

        $id = $this->request->getPost('id');
        $table = $this->request->getPost('table');
        $nama_kolom_lama = $this->request->getPost('nama_kolom_lama');
        $nama_kolom = $this->request->getPost('nama_kolom');
        $tipe_data = $this->request->getPost('tipe_data');
        $panjang = $this->request->getPost('panjang');

        if (!$panjang) {
            $panjang = '225';
        }

        if ($tipe_data != 'date') {
            $tipe_data = "$tipe_data($panjang)";
        }

        $sqlQuery = "ALTER TABLE $table CHANGE $nama_kolom_lama $nama_kolom $tipe_data";

        $db = \Config\Database::connect();
        $db->query($sqlQuery);
        $db->transStart();

        // Lakukan perubahan skema di sini

        $db->transComplete();

        if ($db->transStatus() === false) {
            // Jika transaksi gagal
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }


        $res = array('status' => true, 'msg' => success_update(), 'id' => $id);
        return $this->response->setJSON($res);
    }

    public function delete_table()
    {

        $rules = [
            'id' => 'required',
            'table' => 'required',
        ];

        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => 'Form tidak lengkap');
            return $this->response->setJSON($res);
        }

        $id = $this->request->getPost('id');
        $table = $this->request->getPost('table');

        $sqlQuery = "DROP TABLE $table";

        $db = \Config\Database::connect();
        $db->query($sqlQuery);
        $db->transStart();

        // Lakukan perubahan skema di sini

        $db->transComplete();

        if ($db->transStatus() === false) {
            // Jika transaksi gagal
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        $d = $this->model->delete($id);

        if (!$d) {
            session()->setFlashdata('success', failed());
        }


        $res = array('status' => true, 'msg' => success_delete());
        return $this->response->setJSON($res);
    }


    public function delete_kolom()
    {
        $rules = [
            'nama_kolom' => 'required',
            'table' => 'required',
        ];

        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => 'Form tidak lengkap');
            return $this->response->setJSON($res);
        }

        $id = $this->request->getPost('id');
        $table = $this->request->getPost('table');
        $nama_kolom = $this->request->getPost('nama_kolom');




        $sqlQuery = "ALTER TABLE $table DROP COLUMN  $nama_kolom";

        $db = \Config\Database::connect();
        $db->query($sqlQuery);
        $db->transStart();

        // Lakukan perubahan skema di sini

        $db->transComplete();

        if ($db->transStatus() === false) {
            // Jika transaksi gagal
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }


        $res = array('status' => true, 'msg' => success_delete(), 'id' => $id);
        return $this->response->setJSON($res);
    }


    public function get_row_kolom()
    {
        $id = $this->request->getPost('id');
        $kolom = $this->request->getPost('kolom');
        $row = $this->model->get_row_variable($id, $kolom);

        if ($row) {
            $response = array('status' => true, 'data' => $row);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'msg' =>  'Data tidak ditemukan');
            echo json_encode($response);
        }
    }

    public function get_info()
    {
        $id =  $this->request->getPost('id');
        $table = $this->model->get_table($id);
        $rows = $this->model->get_table_info($id);

        $arr = array();
        foreach ($rows as $row) {

            $c_key = ubah_key($row);
            $arr[] = $c_key;
        }

        $data['id'] = $id;
        $data['field'] = $arr;
        $data['table'] = $table;
        return view($this->path . '/info', $data);
    }
}