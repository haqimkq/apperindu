<?php

namespace App\Controllers;

use App\Models\M_kendali_proses;
use App\Models\Master\M_izin;
use App\Models\Master\M_permohonan;
use Config\Services;

class Rekap_rekomendasi extends BaseController
{

    private $page = 'Rekap Rekomendasi';
    private $url = 'rekap_rekomendasi';
    private $path = 'rekap_rekomendasi';

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
        $data['izin'] = $this->model_izin->get_data();
        $data['permohonan'] = $this->model_permohonan->get_data();


        return view($this->path . '/view', $data);
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
            $rekom = 'doc/sign/rekomendasi_' . $l['tblizinpendaftaran_id'] . '.pdf';
            $opsi = '<div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">';

            $opsi .= '<li><a class="dropdown-item"  href="#" onclick="review(\'' . $rekom . '\')">Lihat Rekomendasi</a>
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