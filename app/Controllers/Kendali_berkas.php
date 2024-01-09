<?php

namespace App\Controllers;

use App\Models\M_kendali_proses;
use App\Models\Master\M_blok_sistem;
use App\Models\Master\M_blok_sistem_tugas;
use App\Models\Master\M_izin;
use App\Models\Master\M_kendali_alur;
use App\Models\Master\M_permohonan;
use Config\Services;

class Kendali_berkas extends BaseController
{

    private $page = 'Kendali Berkas';
    private $url = 'kendali_berkas';
    private $path = 'kendali_berkas';

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
        $this->model_kendali_alur  = new M_kendali_alur($this->request);
    }


    public function view($str)
    {

        $this->jml_validasi_berkas();
        $this->page = $this->page . ' ' . $this->name_it($str);
        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url . '/view/' . $str;
        $data['path'] = $this->path;
        $data['str'] = $str;
        $data['izin'] = $this->model_izin->get_data();
        $data['permohonan'] = $this->model_permohonan->get_data();


        return view($this->path . '/view', $data);
    }

    private function name_it($str)
    {
        if ($str == 'dikirim') {
            return 'Dikirim';
        }

        if ($str == 'salah_kirim') {
            return 'Salah Kirim';
        }

        return 'Arsip';
    }


    public function form_page($id)
    {

        $this->model_blok_sistem_tugas  = new M_blok_sistem_tugas($this->request);
        $this->model_blok_sistem  = new M_blok_sistem($this->request);

        $r = $this->model->get_by_id($id);


        $bs = $this->model_kendali_alur->get_kendali_alur_by_id_permohonan($r['tblizinpermohonan_id'])->get()->getResultArray();

        if (!$bs) {
            $bs = $this->model_blok_sistem->get_data();
        }

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = 'ROUTING SLIP';
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['request'] = $this->request;
        $data['r'] = $r;
        $data['p'] = $this->model_blok_sistem_tugas->get_by_id_blok_sistem(session()->blok_sistem_id)->get()->getResultArray();
        $data['bs'] = $bs;
        $data['nb'] = $this->get_next_blok($r['tblizinpermohonan_id']);

        return view($this->path . '/form_page', $data);
    }

    public function form()
    {


        // insert kendali alur progres
        $kirim_ke = $this->request->getPost('tblkendalibloksistem_idkirim');

        $status = 4;

        if ($kirim_ke == 12) {
            $status = 2;
        }

        $time = date('Y-m-d H:i:s');
        $tm = date('H:i:s');

        $d['tblizinpendaftaran_id'] = $this->request->getPost('tblizinpendaftaran_id');
        $d['tblkendalibloksistemtugas_id'] =  $this->request->getPost('tblkendalibloksistemtugas_id');
        $d['tblkendaliproses_tglmulai'] = $this->request->getPost('tblkendaliproses_tglmulai') . ' ' . $tm;
        $d['tblkendaliproses_tglmulai_sys'] = $this->request->getPost('tblkendaliproses_tglmulai_sys');
        $d['tblkendaliproses_tglselesai'] = $this->request->getPost('tblkendaliproses_tglselesai') . ' ' . $tm;
        $d['tblkendaliproses_tglselesai_sys'] = $time;
        $d['tblkendalibloksistem_idasal'] = session()->blok_sistem_id;
        $d['tblkendalibloksistem_idkirim'] = $kirim_ke;
        $d['tblkendaliproses_catatan'] =  $this->request->getPost('tblkendaliproses_catatan');
        $d['tblkendaliproses_isparaf'] =  $this->request->getPost('tblkendaliproses_isparaf');
        $d['tblkendaliproses_isberkasfisikdikirim'] =  $this->request->getPost('tblkendaliproses_isberkasfisikdikirim');
        $d['tblkendaliproses_tglberkasfisikdikirim'] = $this->request->getPost('tblkendaliproses_tglberkasfisikdikirim') . ' ' . $tm;
        $d['tblkendaliproses_tglberkasfisikdikirim_sys'] = $time;
        $d['tblkendaliproses_tglterima'] = $time;
        $d['tblkendaliproses_status'] = $status;
        $d['tblkendaliproses_jamlambat'] = 0;
        $d['tblkendaliproses_harilambat'] = 0;
        $d['tblkendaliproses_jamlambat_sys'] = 0;
        $d['tblkendaliproses_harilambat_sys'] = 0;
        $d['tblpengguna_id'] = session()->id;

        $i = $this->model->save($d);

        $id_proses = $this->request->getPost('tblkendaliproses_id');
        $r = $this->model->find($id_proses);

        if ($r['tblkendaliproses_status']  == 3) {
            $u['tblkendaliproses_status'] = 5;
            $this->model->update($id_proses, $u);
        }

        if ($r['tblkendaliproses_status']  == 4) {
            $u['tblkendaliproses_status'] = 2;
            $this->model->update($id_proses, $u);
        }


        if ($i) {
            session()->setFlashdata('success', 'Berkas berhasil dikirim');
        } else {
            session()->setFlashdata('error', failed());
        }

        return redirect()->to('/' . 'kendali_berkas/view/arsip');
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

            if ($str == 'dikirim'  || $str == 'salah_kirim') {
                $opsi .= '<li><a class="dropdown-item"  href="' . site_url($this->url . '/form_page/' . $l[$this->primaryKey]) . '">Kirim</a>
                    </li>';
            }
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
            $row[] = '<div class="text-wrap">' . $l['tblkendalibloksistemtugas_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['nama_tujuan'] . '</div>';
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




    private function get_next_blok($id)
    {


        $r =  $this->model_kendali_alur->get_by_permohonan_and_blok_sistem($id);

        if (!$r) {
            return '';
        }

        $no_urut = $r['tblkendalialur_urut'];
        $no_urut++;

        $d = $this->model_kendali_alur->get_by_permohonan_and_no_urut($id, $no_urut);

        if (!$d) {
            return '';
        }

        return $d['tblkendalibloksistem_id'];
    }


    public function jml_validasi_berkas(){
   

        echo  'Validasi Berkas <span class="badge bg-primary">'.$this->model->jml_validasi_berkas().'</span>';
    }
}