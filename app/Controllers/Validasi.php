<?php

namespace App\Controllers;

use App\Models\M_kendali_proses;
use App\Models\Master\M_blok_sistem;
use App\Models\Master\M_blok_sistem_tugas;
use App\Models\Master\M_izin;
use App\Models\Master\M_permohonan;
use Config\Services;

class Validasi extends BaseController
{

    private $page = 'Validasi Berkas';
    private $url = 'validasi';
    private $path = 'validasi';

    protected $model;
    protected $model_pendaftaran;
    protected $model_blok_sistem;
    protected $model_kendali_alur;
    protected $model_izin;
    protected $model_permohonan;
    protected $primaryKey       = 'tblkendaliproses_id';
    protected $model_blok_sistem_tugas;
    protected $request;

    public function __construct()
    {
        $this->request = Services::request();
        $this->model = new M_kendali_proses($this->request);
        $this->model_izin = new M_izin($this->request);
        $this->model_permohonan = new M_permohonan($this->request);
    }


    public function index()
    {


        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['str'] = 'dikirim';
        $data['izin'] = $this->model_izin->get_data();
        $data['permohonan'] = $this->model_permohonan->get_data();


        return view($this->path . '/view', $data);
    }




    public function form_page($id)
    {

        $this->model_blok_sistem_tugas  = new M_blok_sistem_tugas($this->request);
        $this->model_blok_sistem  = new M_blok_sistem($this->request);

        $r = $this->model->get_by_id($id);

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = 'ROUTING SLIP';
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['request'] = $this->request;
        $data['r'] = $r;
        $data['p'] = $this->model_blok_sistem_tugas->get_by_id_blok_sistem(session()->blok_sistem_id)->get()->getResultArray();
        $data['bs'] = $this->model_blok_sistem->get_data();
        $data['nb'] = $this->get_next_blok($r['tblizinpermohonan_id']);

        return view($this->path . '/form_page', $data);
    }



    public function get_data()
    {


        $lists = $this->model->getDatatables();
        $data = [];
        $no = $this->request->getPost('start');
        $str =  $this->request->getPost('str');
        foreach ($lists as $l) {
            $no++;
            $row = [];
            $row[] = $no . '.';

            $opsi = '<div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">';

            $opsi .= '<li><a class="dropdown-item"  href="#" onclick="lihat_persyaratan(\'' . $l['tblizinpendaftaran_id'] . '\')">Lihat Persyaratan</a>
            </li>';
            $opsi .= '<li><a class="dropdown-item"  href="' . site_url('kendali_berkas/form_page/' . $l[$this->primaryKey]) . '">Kirim</a>
            </li>';
            $opsi .= '<li><a class="dropdown-item"  href="#" onclick="log(\'' . $l['tblizinpendaftaran_id'] . '\')">Log Berkas</a>
            </li>
               
             
            </div>';

            $row[] = $opsi;
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_nomor'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_namapemohon'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_usaha'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['nama_asal'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblkendaliproses_catatan'] . '</div>';
            $row[] = '<div class="text-wrap">' . tanggal($l['tblkendaliproses_tglterima']) . '</div>';




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
}