<?php

namespace App\Controllers;

use App\Models\M_doc;
use Config\Services;
use App\Models\M_pemohon;
use App\Models\M_pendaftaran;
use App\Models\Master\M_pengguna;
use App\Models\Master\M_template;

class Pemohon extends BaseController
{

    private $page = 'Pemohon';
    private $url = 'pemohon';
    private $path = 'pemohon';

    protected $model;
    protected $model_pendaftaran;
    protected $model_doc;
    protected $model_template;
    protected $model_pengguna;
    protected $request;
    protected $primaryKey = 'tblpemohon_id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_pemohon($this->request);
        $this->model_pendaftaran = new M_pendaftaran($this->request);
        $this->model_doc = new M_doc();
        $this->model_template  = new M_template($this->request);
        $this->model_pengguna =  new M_pengguna($this->request);
    }


    public function index()

    {

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;



        return view($this->path . '/view', $data);
    }


    public function arsip($id)

    {

        $data['title'] = 'Arsip Pemohon';
        $data['page'] = 'Arsip Pemohon';
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $rows = $this->model_pendaftaran->get_by_id_pemohon($id);

        $arr = array();

        foreach ($rows as $r) {

            $tabel_info = $this->model_template->get_table_info($r['tblizinpermohonan_id']);
            $r['tgl_penetapan'] = NULL;
            $r['berlaku_sampai'] = NULL;
            foreach ($tabel_info as  $t) {
                if ($t->name == 'tgl_penetapan') {

                    if ($t->type_name == 'date') {
                        $tabel = $this->model_template->get_table($r['tblizinpermohonan_id']);
                        $row = $this->model_template->get_row_tertentu($tabel, $r['tblizinpendaftaran_id']);
                        $r['tgl_penetapan'] = tanggal($row['tgl_penetapan']);
                    }
                }

                if ($t->name == 'berlaku_sampai') {

                    if ($t->type_name == 'date') {
                        $tabel = $this->model_template->get_table($r['tblizinpermohonan_id']);
                        $row = $this->model_template->get_row_tertentu($tabel, $r['tblizinpendaftaran_id']);
                        $r['berlaku_sampai'] = tanggal($row['berlaku_sampai']);
                    }
                }
            }


            if ($r['tblizinpendaftaran_issign'] == 'T') {
                $r['sebelum_tte'] = site_url('tte/before_tte/' . $this->model_doc->encrypt($r['tblizinpendaftaran_id'], key_secret()));
                $r['sesudah_tte'] = site_url('tte/after_tte/' . $this->model_doc->encrypt($r['tblizinpendaftaran_id'], key_secret()));
            } else {
                $r['sebelum_tte'] = NULL;
                $r['sesudah_tte'] = NULL;
            }

            $arr[] = $r;
        }


        $data['arsip'] = $arr;




        return view($this->path . '/arsip/view', $data);
    }


    public function arsip_api()

    {


        $id = $this->request->getVar('tblpemohon_id');

        $rows = $this->model_pendaftaran->get_by_id_pemohon_selesai($id);

        $arr = array();

        foreach ($rows as $r) {

            $tabel_info = $this->model_template->get_table_info($r['tblizinpermohonan_id']);
            $r['tgl_daftar'] = tanggal($r['tblizinpendaftaran_tgljam']);
            $r['tgl_penetapan'] = NULL;
            $r['berlaku_sampai'] = NULL;

            foreach ($tabel_info as  $t) {
                if ($t->name == 'tgl_penetapan') {

                    if ($t->type_name == 'date') {
                        $tabel = $this->model_template->get_table($r['tblizinpermohonan_id']);
                        $row = $this->model_template->get_row_tertentu($tabel, $r['tblizinpendaftaran_id']);
                        $r['tgl_penetapan'] = tanggal($row['tgl_penetapan']);
                    }
                }

                if ($t->name == 'berlaku_sampai') {

                    if ($t->type_name == 'date') {
                        $tabel = $this->model_template->get_table($r['tblizinpermohonan_id']);
                        $row = $this->model_template->get_row_tertentu($tabel, $r['tblizinpendaftaran_id']);
                        $r['berlaku_sampai'] = tanggal($row['berlaku_sampai']);
                    }
                }
            }

            $r['dokumen'] = base_url('permohonan/dokumen/' . $this->model_doc->encrypt($r['tblizinpendaftaran_id'], key_secret()));


            $arr[] = $r;
        }


        $data['arsip'] = $arr;

        $res = array('status' => true, 'msg' => 'Data ditemukan', 'data' => $data['arsip']);
        return $this->response->setJSON($res);
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

            $row[] = '  <div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">
               
       
                <li><a class="dropdown-item" href="' . site_url('pendaftaran/form_page/' . $l[$this->primaryKey]) . '">Daftarkan</a>
                </li>
                <li><a class="dropdown-item" href="' . site_url('pemohon/arsip/' . $l[$this->primaryKey]) . '">Arsip</a>
                </li>
                <li><a class="dropdown-item" href="' . site_url($this->url . '/form_page/' . $l[$this->primaryKey]) . '">Edit</a>
                </li>
                <li><a class="dropdown-item" href="#" onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</a>
                </li>
            </ul>
        </div>';

            $row[] = $l['tblpemohon_nama'];
            $row[] = '<div class="text-wrap">' . $l['tblpemohon_alamat'] . '</div>';
            $row[] = $l['tblpemohon_noidentitas'];
            $row[] = '<div class="text-wrap">' . $l['tblpemohon_npwp'] . '</div>';

            $row[] = '<div class="text-wrap">' . $l['tblpemohon_telpon'] . '</div>';


            $row[] = '<div class="text-wrap">' . $l['tblpemohon_email'] . '</div>';
            $row[] = pendaftaran($l['tblpemohon_idonline']);
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

    public function get_data_arsip()
    {


        $lists = $this->model_pendaftaran->getDatatables();
        $data = [];
        $no = $this->request->getPost('start');

        foreach ($lists as $l) {
            $no++;
            $row = [];
            $row[] = $no . '.';

            $opsi = '<div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">

                <li><a class="dropdown-item" onclick="lihat_persyaratan(\'' . $l['tblizinpendaftaran_id'] . '\')"  href="#">Persyaratan</a>
                </li>
          
                <li><a class="dropdown-item"  href="#" onclick="log(\'' . $l['tblizinpendaftaran_id'] . '\')">Log</a>
                </li>';

            if ($l['tblizinpendaftaran_issign'] == 'T') {
                $opsi .= '<li><a class="dropdown-item" target="_blank" href="' . site_url('tte/before_tte/' . $this->model_doc->encrypt($l['tblizinpendaftaran_id'], key_secret())) . '">Sebelum TTE</a>
                </li>
                
                <li><a class="dropdown-item" target="_blank"  href="' . site_url('tte/after_tte/' . $this->model_doc->encrypt($l['tblizinpendaftaran_id'], key_secret())) . '">Sesudah TTE</a>
                </li>
                ';
            }

            $opsi .= '</ul>
            </div>';

            $row[] = $opsi;

            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_nomor'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_namapemohon'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_usaha'] . '</div>';
            $row[] = pendaftaran($l['tblizinpendaftaran_idonline']);
            $row[] = status_pendaftaran($l['tblizinpendaftaran_issign']);
            $row[] = '<div class="text-wrap">' . tanggal($l['tblizinpendaftaran_tgljam']) . '</div>';




            $data[] = $row;
        }

        $output = [
            'draw' => $this->request->getPost('draw'),
            'recordsTotal' => $this->model_pendaftaran->countAll(),
            'recordsFiltered' => $this->model_pendaftaran->countFiltered(),
            'data' => $data
        ];

        echo json_encode($output);
    }

    public function form_page()
    {
        $data['title'] = 'Form ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['request'] = $this->request;
        $data['identitas'] = $this->get_jenis_identitas();


        return view($this->path . '/form_page', $data);
    }

    private function get_jenis_identitas()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('refjenisidentitas');

        return $builder->get()->getResultArray();
    }

    public function form()
    {

        $rules = [
            'tblpemohon_noidentitas' => 'required',
            'tblpemohon_nama' => 'required',
            'tblpemohon_alamat' => 'required',
            'tblpemohon_npwp' => 'required',
            'tblpemohon_telpon' => 'required',
            'tblpemohon_email' => 'required'
        ];


        $id = $this->request->getPost('id');

        foreach ($this->model->allowedfields() as $r) {
            $d[$r] = $this->request->getPost($r);
        }

        $d['refjenisidentitas_id'] = 1;
        $d['tblpemohon_finger'] = '';

        if ($this->validate($rules)) {
            if ($id) {
                $u =  $this->model->update($id, $d);

                if ($u) {
                    session()->setFlashdata('success', success_update());
                } else {
                    session()->setFlashdata('error', failed());
                }
            } else {
                $i =  $this->model->save($d);
                $id = $this->model->getInsertID();


                if ($i) {
                    session()->setFlashdata('success', success_add() . ', lanjut mengisi pendaftaran');
                    return redirect()->to('/pendaftaran/form_page/' . $id);
                } else {
                    session()->setFlashdata('error', failed());
                }
            }
        } else {
            session()->setFlashdata('error', failed());
        }



        return redirect()->to('/' . $this->url);
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




    public function delete()
    {

        $id = $this->request->getPost('id');
        $row = $this->model->find($id);
        $id_pengguna = $row['tblpengguna_id'];

        $this->model_pengguna->where('tblpengguna_id', $id_pengguna)->delete();

        $d = $this->model->delete($id);


        if ($d) {
            session()->setFlashdata('success', success_delete());
        } else {
            session()->setFlashdata('error', failed());
        }

        return redirect()->to('/' . $this->url);
    }
}