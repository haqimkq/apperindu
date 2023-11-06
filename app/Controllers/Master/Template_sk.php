<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\M_doc;
use App\Models\M_pengaturan;
use App\Models\Master\M_izin;
use App\Models\Master\M_permohonan;
use App\Models\Master\M_template;
use Config\Services;


class Template_sk extends BaseController
{
    private $page = 'Template SK';
    private $url = 'template_sk';
    private $path = 'Master/template_sk';

    protected $model;
    protected $model_izin;
    protected $model_permohonan;
    protected $model_variable_sk;
    protected $model_doc;
    protected $model_pengaturan;
    protected $request;
    protected $primaryKey = 'tblskizin_id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_template($this->request);
        $this->model_permohonan =  new M_permohonan($this->request);
        $this->model_izin =  new M_izin($this->request);
        $this->model_doc = new M_doc();
    }

    public function index()
    {

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['izin'] = $this->model_izin->get_data();
        $data['permohonan'] = $this->model_permohonan->findAll();
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
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">
            
                <li><a class="dropdown-item" href="' . site_url($this->url . '/testing/' . $l[$this->primaryKey]) . '">Uji coba template</a>
                </li>
                <li><a class="dropdown-item" href="' . site_url($this->url . '/form_page/' . $l[$this->primaryKey]) . '">Edit</a>
                </li>
                <li><a class="dropdown-item" href="#" onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</a>
                </li>
            </ul>
            </div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap"><a href="' . base_url('doc/template/' . $l['tblskizin_sktemplate']) . '">' . $l['tblskizin_sktemplate'] . '</a></div>';
            $row[] = '<div class="text-wrap">' . $l['tblskizin_tabelsk'] . '</div>';

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

    public function form_page($id = null)
    {

        $this->model_variable_sk =  new \App\Models\Master\M_variabel_sk($this->request);
        $data['title'] = 'Form ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['request'] = $this->request;
        $data['izin'] = $this->model_izin->findAll();
        $data['permohonan'] = $this->model_permohonan->get_permohonan_where_not_in();


        if ($id) {

            $data['variabel'] = $this->model_variable_sk->findAll();
            return view($this->path . '/form_update_page', $data);
        }

        $data['variabel'] = $this->model_variable_sk->findAll();
        return view($this->path . '/form_page', $data);
    }

    public function form()
    {
        $rules = [
            'tblizin_id' => 'required',
            'tblizinpermohonan_id' => 'required',

            'tblskizin_sktemplate' => [
                'rules' => 'uploaded[tblskizin_sktemplate]|ext_in[tblskizin_sktemplate,rtf]',
                'errors' => [
                    'uploaded' => 'Harap upload file template',
                    'ext_in' => 'Harap upload file template dengan format rtf'

                ]
            ],
        ];

        if (!$this->validate($rules)) {


            $res = array('status' => false, 'msg' => $this->validator->getError('tblskizin_sktemplate'));
            return $this->response->setJSON($res);
        }


        foreach ($this->model->allowedfields() as $r) {
            $d[$r] = $this->request->getPost($r);
        }


        $file = $this->request->getFile('tblskizin_sktemplate');
        $file->move('doc/template');
        $d['tblskizin_sktemplate'] = $file->getName();


        $i =  $this->model->save($d);

        if ($i) {
            $res = array('status' => true, 'msg' => success_add());
            return $this->response->setJSON($res);
        }

        $res = array('status' => false, 'msg' => failed());
        return $this->response->setJSON($res);
    }

    public function update_template()
    {

        $id = $this->request->getPost('id');
        $tblskizin_sktemplate_old = $this->request->getPost('tblskizin_sktemplate_old');
        $file = $this->request->getFile('tblskizin_sktemplate');

        $rules = [

            'tblskizin_sktemplate' => [
                'rules' => 'uploaded[tblskizin_sktemplate]|ext_in[tblskizin_sktemplate,rtf]',
                'errors' => [
                    'uploaded' => 'Harap upload file template',
                    'ext_in' => 'Harap upload file template dengan format rtf'

                ]
            ],
        ];



        if (!$this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getError('tblskizin_sktemplate'));
            return redirect()->to('/' . $this->url . '/testing/' . $id);
        }


        if (file_exists('doc/template/' . $tblskizin_sktemplate_old)) {
            // unlink('doc/template/' . $tblskizin_sktemplate_old);
        }


        $file->move('doc/template');

        $d['tblskizin_sktemplate'] = $file->getName();


        $u =  $this->model->update($id, $d);



        if (!$u) {
            session()->setFlashdata('error', failed());
            return redirect()->to('/' . $this->url . '/testing/' . $id);
        }

        session()->setFlashdata('success', success_update());
        return redirect()->to('/' . $this->url . '/testing/' . $id);
    }

    public function form_update()
    {
        $rules = [
            'tblizin_id' => 'required',
            'tblizinpermohonan_id' => 'required',

            'tblskizin_sktemplate' => [
                'rules' => 'ext_in[tblskizin_sktemplate,rtf]',
                'errors' => [
                    'ext_in' => 'Harap upload file template dengan format rtf'

                ]
            ],
        ];

        if (!$this->validate($rules)) {


            $res = array('status' => false, 'msg' => $this->validator->getError('tblskizin_sktemplate'));
            return $this->response->setJSON($res);
        }

        $id = $this->request->getPost('id');
        foreach ($this->model->allowedfields() as $r) {
            $d[$r] = $this->request->getPost($r);
        }


        $file = $this->request->getFile('tblskizin_sktemplate');

        if ($file->getError() == 4) {
            $d['tblskizin_sktemplate'] = $this->request->getPost('tblskizin_sktemplate_old');
        } else {

            if (file_exists('doc/template/' . $this->request->getPost('tblskizin_sktemplate_old'))) {
                // unlink('doc/template/' . $this->request->getPost('tblskizin_sktemplate_old'));
            }


            $file->move('doc/template');
            $d['tblskizin_sktemplate'] = $file->getName();
        }




        $u =  $this->model->update($id, $d);

        if ($u) {
            $res = array('status' => true, 'msg' => success_update());
            return $this->response->setJSON($res);
        }

        $res = array('status' => false, 'msg' => failed());
        return $this->response->setJSON($res);
    }


    public function get_row()
    {
        $id = $this->request->getPost('id');
        $row = $this->model->find($id);

        if ($row) {
            $response = array('status' => true, 'data' => $row);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'msg' =>  'Data tidak ditemukan');
            echo json_encode($response);
        }
    }

    public function get_permohonan_by_id_izin_json()
    {

        $id = $this->request->getPost('id_izin');
        $rows = $this->model_permohonan->get_permohonan_by_id_izin($id)->get()->getResultArray();


        if ($rows) {
            $response = array('status' => true, 'data' => $rows);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'msg' =>  'Data tidak ditemukan');
            echo json_encode($response);
        }
    }

    public function get_permohonan_where_not_in()
    {

        $id = $this->request->getPost('id_izin');
        $id_permohonan = $this->request->getPost('id_permohonan');
        $rows = $this->model_permohonan->get_permohonan_where_not_in($id, $id_permohonan);


        if ($rows) {
            $response = array('status' => true, 'data' => $rows);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'msg' =>  'Data tidak ditemukan');
            echo json_encode($response);
        }
    }

    public function testing($id)
    {

        $this->model_pengaturan = new M_pengaturan();
        $row = $this->model->get_by_id($id);
        $qr = $this->model_doc->get_img(qr_dir(), array('width' => 3, 'height' => 3));
        $pas_foto = $this->model_doc->get_img(pas_foto_dir(), array('width' => 3, 'height' => 4));

        // load pengaturan
        $peng  = $this->model_pengaturan->get_row();

        // variabel data primary

        $variable['nama_pemohon'] = replace_variable('nama_pemohon');
        $variable['alamat_pemohon'] = replace_variable('alamat_pemohon');

        $variable['tgl_permohonan'] = tanggal(date('Y-m-d'));
        $variable['nama_usaha'] = replace_variable('nama_usaha');
        $variable['alamat_usaha'] = replace_variable('alamat_usaha');
        $variable['npwp'] = replace_variable('npwp');
        $variable['nik'] = replace_variable('nik');

        // variabel tte
        $variable['pas_foto'] = $pas_foto;
        $variable['qr_ttd'] = '';
        $variable['bsre_logo'] = '';
        $variable['TTD'] = $qr;
        $variable['nama_kadis'] = $peng['nama_kadis'];
        $variable['pangkat_kadis'] = $peng['pangkat_kadis'];
        $variable['nip_kadis'] = $peng['nip_kadis'];
        $variable['footer_ttd'] = footer_tte();



        $tabel_info = $this->get_table_info($row['tblskizin_tabelsk']);



        foreach ($tabel_info as $key => $t) {
            if ($key != 0) {


                // variabel data secondary
                if ($t->type_name == 'date') {
                    $variable[$t->name] = tanggal(date('Y-m-d'));
                } else {
                    $variable[$t->name] = replace_variable($t->name);
                }
            }
        }

        $output =  word_dir('testing.docx');
        $template = 'doc/template/' . $row['tblskizin_sktemplate'];


        // jika template tidak ditemukan
        if (!file_exists($template)) {
            $res = array('status' => false, 'msg' => 'Template tidak ditemukan, harap hubungi administrator untuk membuatnya');
            return $this->response->setJSON($res);
        }

        $this->model_doc->processRTFTemplate($template, $output, $variable);

        $res = $this->model_doc->word2pdf($output, before_tte());
        if (!$res) {
        }

        $path = before_tte($res);
        $pdf = file_get_contents($path);
        $base64 = base64_encode($pdf);



        $data['title'] = 'Uji Coba Template';
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['request'] = $this->request;
        $data['template'] =  $row['tblskizin_sktemplate'];
        $data['table'] = $row['tblskizin_tabelsk'];
        $data['base64'] = $base64;
        return view($this->path . '/testing', $data);
    }



    private function get_table_info($table)
    {

        $db = \Config\Database::connect();
        $query = $db->table($table)->get();

        $fields = $query->getFieldData();

        return $fields;
    }
}