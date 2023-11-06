<?php

namespace App\Controllers;

use App\Models\M_doc;
use Config\Services;

use App\Models\M_kendali_proses;

use App\Models\M_pendaftaran_online;
use App\Models\M_pengaturan;
use App\Models\M_persyaratan_pemohon;

use App\Models\Master\M_izin;
use App\Models\Master\M_permohonan;
use App\Models\Master\M_persyaratan_permohonan;


class Pendaftaran_online extends BaseController
{

    private $page = 'Pendaftaran Online';
    private $url = 'pendaftaran_online';
    private $path = 'pendaftaran_online';

    protected $model;
    protected $model_pendaftaran;
    protected $model_persyaratan;
    protected $model_persyaratan_pemohon;
    protected $model_kendali_proses;
    protected $model_izin;
    protected $model_permohonan;
    protected $model_pengaturan;
    protected $model_doc;
    protected $primaryKey = 'tblizinpendaftaran_id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_pendaftaran_online($this->request);
        $this->model_persyaratan = new M_persyaratan_permohonan($this->request);
        $this->model_persyaratan_pemohon = new M_persyaratan_pemohon($this->request);
        $this->model_izin =  new M_izin($this->request);
        $this->model_permohonan =  new M_permohonan($this->request);
        $this->model_kendali_proses = new M_kendali_proses($this->request);
        $this->model_pengaturan = new M_pengaturan();
        $this->model_doc = new M_doc();
    }


    public function index()

    {


        $data['title'] = 'Data ' . $this->page;
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

        foreach ($lists as $l) {
            $no++;
            $row = [];
            $row[] = $no . '.';

            $opsi = '<div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">
             
              
                <li><a class="dropdown-item"  href="' . site_url($this->url . '/review/' . $l[$this->primaryKey]) . '">Review</a>
             
                <li><a class="dropdown-item" href="#" onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</a>
                </li>
            </ul>
            </div>';

            $row[] = $opsi;
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_nomor'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_namapemohon'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_usaha'] . '</div>';

            $row[] = status_online($l['status_online']);
            $row[] = '<div class="text-wrap">' . tanggal($l['tblizinpendaftaran_tgljam']) . '</div>';




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


    public function review($id)
    {

        $r = $this->model->get_by_id($id);

        $data['r'] =  $r;
        $data['title'] = 'Review';
        $data['page'] = 'Review Pendaftaran Online';
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['persyaratan'] = $this->persyaratan($r['tblizinpermohonan_id'], $r['tblpemohon_id']);


        return view($this->path . '/review', $data);
    }


    public function persyaratan($id, $id_pemohon)
    {
        $rows =   $this->model_persyaratan->get_persyaratan_by_id_permohonan($id)->get()->getResultArray();
        $arr = array();
        foreach ($rows as $r) {

            $r['file'] = $this->get_persyaratan_pemohon($id_pemohon, $r['tblpersyaratan_id']);
            $arr[] = $r;
        }

        return $arr;
    }

    public function get_persyaratan_pemohon($id_pemohon, $id_persyaratan)
    {

        $row = $this->model_persyaratan_pemohon->get_by_id_pemohon_and_persyaratan($id_pemohon, $id_persyaratan);

        if ($row) {
            return $row['tblpemohonpersyaratan_file'];
        }

        return null;
    }

    public function form_page($id)
    {


        $this->model_kecamatan =  new \App\Models\Master\M_kecamatan($this->request);
        $data['title'] = 'Form ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['id_pemohon'] = $id;
        $data['izin'] = $this->model_izin->get_data();
        $data['kecamatan'] = $this->model_kecamatan->findAll();


        return view($this->path . '/form_page', $data);
    }

    public function tolak()
    {
        $id = $this->request->getPost('id');
        $alasan = $this->request->getPost('alasan');
        $time = date('Y-m-d H:i:s');
        // insert kendali alur progres
        $d3['tblizinpendaftaran_id'] = $id;
        // 9 adalah input pendaftaran berkas
        $d3['tblkendalibloksistemtugas_id'] = 2;
        $d3['tblkendaliproses_tglmulai'] = $time;
        $d3['tblkendaliproses_tglmulai_sys'] = $time;
        $d3['tblkendaliproses_tglselesai'] = $time;
        $d3['tblkendaliproses_tglselesai_sys'] = $time;
        // staf pendaftaran
        $d3['tblkendalibloksistem_idasal'] = session()->blok_sistem_id;

        // 12 adalah pemohon
        $d3['tblkendalibloksistem_idkirim'] =  12;
        $d3['tblkendaliproses_catatan'] = $alasan;
        $d3['tblkendaliproses_isparaf'] = 'T';
        $d3['tblkendaliproses_isberkasfisikdikirim'] = 'T';
        $d3['tblkendaliproses_tglberkasfisikdikirim'] = $time;
        $d3['tblkendaliproses_tglberkasfisikdikirim_sys'] = $time;
        $d3['tblkendaliproses_tglterima'] = $time;
        // 4 belum tahu ? apa itu 4 ihh ai lah
        $d3['tblkendaliproses_status'] = 10;
        $d3['tblpengguna_id'] = session()->id;



        $in =  $this->model_kendali_proses->save($d3);

        if (!$in) {
            session()->setFlashdata('error', failed());
        }


        $d['status_online'] =  2;
        $up =  $this->model->update($id, $d);


        if ($up) {

            $row = $this->model->get_by_id($id);
            $number = $row['tblizinpendaftaran_telponpemohon'];
            if ($number) {

                $r = $this->model_pengaturan->get_row();
                $variable['nama_pemohon'] = $row['tblizinpendaftaran_namapemohon'];
                $variable['tgl_permohonan'] = tanggal($row['tblizinpendaftaran_tgljam']);
                $variable['nama_usaha'] = $row['tblizinpendaftaran_usaha'];
                $variable['alamat_usaha'] = $row['tblizinpendaftaran_lokasiizin'];
                $variable['alamat_pemohon'] = $row['tblizinpendaftaran_almtpemohon'];
                $variable['npwp'] = $row['tblizinpendaftaran_npwp'];
                $variable['nik'] = $row['tblizinpendaftaran_idpemohon'];
                $variable['no_pendaftaran'] = $row['tblizinpendaftaran_nomor'];
                $variable['alasan'] = $alasan;
                $msg = $this->model_pengaturan->replaceTemplateVariables($r['redaksi_ditolak'], $variable);


                $this->model_doc->send_wa($msg, $number, $r['token_wa']);
            }

            session()->setFlashdata('success', 'Berkas Ditolak');
        } else {
            session()->setFlashdata('error', failed());
        }

        return redirect()->to('/' . $this->url);
    }

    public function terima()
    {
        $id = $this->request->getPost('id');

        $d['status_online'] =  3;
        $up =  $this->model->update($id, $d);


        if ($up) {
            $msg = "Berkas anda sudah kami terima. Selalu periksa perkembangan berkas permohonan anda dengan mengakses halaman daftar permohonan kemudan klik 'opsi' kemudian klik 'detail'";
            $row = $this->model->get_by_id($id);
            $number = $row['tblizinpendaftaran_telponpemohon'];
            if ($number) {
                $r = $this->model_pengaturan->get_row();
                $variable['nama_pemohon'] = $row['tblizinpendaftaran_namapemohon'];
                $variable['tgl_permohonan'] = tanggal($row['tblizinpendaftaran_tgljam']);
                $variable['nama_usaha'] = $row['tblizinpendaftaran_usaha'];
                $variable['alamat_usaha'] = $row['tblizinpendaftaran_lokasiizin'];
                $variable['alamat_pemohon'] = $row['tblizinpendaftaran_almtpemohon'];
                $variable['npwp'] = $row['tblizinpendaftaran_npwp'];
                $variable['nik'] = $row['tblizinpendaftaran_idpemohon'];
                $variable['no_pendaftaran'] = $row['tblizinpendaftaran_nomor'];
                $msg = $this->model_pengaturan->replaceTemplateVariables($r['redaksi_diterima'], $variable);


                $this->model_doc->send_wa($msg, $number, $r['token_wa']);
            }

            session()->setFlashdata('success', 'Lanjut melakukan kendali proses');
        } else {
            session()->setFlashdata('error', failed());
        }

        $row = $this->model_kendali_proses->id_terakhir($id);
        return redirect()->to('/' . 'kendali_berkas/form_page/' . $row['tblkendaliproses_id']);
    }

    public function delete()
    {

        $d = $this->model->delete($this->request->getPost('id'));


        if ($d) {
            session()->setFlashdata('success', success_delete());
        } else {
            session()->setFlashdata('error', failed());
        }

        return redirect()->to('/' . $this->url);
    }
}
