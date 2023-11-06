<?php

namespace App\Controllers;

use App\Models\Api\MJwt;
use App\Models\M_doc;
use Config\Services;
use App\Models\M_kendali_proses;
use App\Models\M_pemohon;
use App\Models\M_pendaftaran;
use App\Models\M_persyaratan_pemohon;
use App\Models\Master\M_izin;
use App\Models\Master\M_permohonan;
use App\Models\Master\M_template;
use App\Models\Master\M_tte_rekomendasi;

class Rekomendasi extends BaseController
{

    private $page = 'Perlu Rekomendasi';
    private $url = 'rekomendasi';
    private $path = 'rekomendasi';

    protected $model;
    protected $model_pendaftaran;
    protected $model_template;
    protected $model_kendali_proses;
    protected $model_doc;
    protected $model_izin;
    protected $model_permohonan;
    protected $model_persyaratan_pemohon;
    protected $model_pemohon;
    protected $model_jwt;
    protected $model_tte_rekomendasi;
    protected $primaryKey = 'tblizinpendaftaran_id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_kendali_proses($this->request);
        $this->model_template = new M_template($this->request);
        $this->model_pendaftaran =  new M_pendaftaran($this->request);
        $this->model_kendali_proses = new M_kendali_proses($this->request);
        $this->model_doc = new M_doc();
        $this->model_izin = new M_izin($this->request);
        $this->model_permohonan = new M_permohonan($this->request);
        $this->model_persyaratan_pemohon = new M_persyaratan_pemohon($this->request);
        $this->model_pemohon = new M_pemohon($this->request);
        $this->model_jwt = new MJwt();
        $this->model_tte_rekomendasi = new M_tte_rekomendasi($this->request);
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

            // $opsi =  ' <a href="' . site_url($this->url . '/form_page/' . $l[$this->primaryKey]) . '" class="btn btn-outline-primary btn-sm" >Cetak</a>';
            $opsi = '<div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . site_url($this->url . '/form_page/' . $l[$this->primaryKey]) . '"  >Cetak Rekomendasi</a>
            </li>
         
            <li><a class="dropdown-item"  href="#" onclick="log(\'' . $l['tblizinpendaftaran_id'] . '\')">Log Berkas</a>
            </li>
             
            </div>';
            $row[] = $opsi;
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_nomor'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_namapemohon'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_usaha'] . '</div>';
            $row[] = '<div class="text-wrap">' . tanggal($l['tblizinpendaftaran_tgljam']) . '</div>';

            $row[] = 'Loket';


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

    public function form_page($id)
    {


        $r = $this->model_pendaftaran->get_by_id($id);
        $field =  $this->get_table_info($r['tblizinpermohonan_id']);

        if (!$field) {
            session()->setFlashdata('error', 'Template tidak ditemukan, harap hubungi administrator untuk membuatnya');
            return redirect()->to('/' . $this->url);
        }

        $table = $this->get_table($r['tblizinpermohonan_id']);
        $row = $this->get_row($table, $id);


        $arr = array();
        foreach ($field as $key => $t) {
            if ($key != 0) {

                $arr[$t->name] = isset($row[$t->name]) ? $row[$t->name] : '';
            }
        }


        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['request'] = $this->request;
        $data['r'] = $r;
        $data['arr'] = $arr;
        $data['field'] = $field;
        $data['table'] = $table;
        $data['sk_terakhir'] = $this->sk_terakhir($table);


        return view($this->path . '/form_page', $data);
    }

    public function form()
    {


        $rekomendasi = $this->model_tte_rekomendasi->get_by_blok_sistem_id();
        $post = $this->request->getPost();
        $r = $this->model_pendaftaran->get_by_id($post['tblizinpendaftaran_id']);

        $variable['nama_pemohon'] = $r['tblizinpendaftaran_namapemohon'];
        $variable['tgl_permohonan'] = tanggal($r['tblizinpendaftaran_tgljam']);
        $variable['nama_usaha'] = $r['tblizinpendaftaran_usaha'];
        $variable['alamat_usaha'] = $r['tblizinpendaftaran_lokasiizin'];
        $variable['alamat_pemohon'] = $r['tblizinpendaftaran_almtpemohon'];
        $variable['izin'] = $r['tblizin_nama'];
        $variable['tblizinpermohonan_id'] = $r['tblizinpermohonan_id'];
        $variable['npwp'] = $r['tblizinpendaftaran_npwp'];
        $variable['nik'] = $r['tblizinpendaftaran_idpemohon'];

        // variabel tte
        $variable['qr_ttd'] = '';
        $variable['bsre_logo'] = '';
        $variable['TTD'] =  '';
        $variable['nama_kadis'] = $rekomendasi['nama'];
        $variable['pangkat_kadis'] = $rekomendasi['pangkat'];
        $variable['nip_kadis'] = $rekomendasi['nip'];
        $variable['footer_ttd'] = footer_tte();

        $per = $this->model_persyaratan_pemohon->get_pas_foto($r['tblpemohon_id']);

        if ($per) {

            $dir =  'doc/persyaratan/' . $per['tblpemohonpersyaratan_file'];
            $pas_foto = $this->model_doc->get_img($dir, array('width' => 3, 'height' => 4));
            $variable['pas_foto'] = $pas_foto;
        }

        $tabel_info = $this->get_table_info($variable['tblizinpermohonan_id']);
        $tabel = $this->get_table($variable['tblizinpermohonan_id']);


        $arr = array();
        foreach ($tabel_info as $key => $t) {
            if ($key != 0) {
                // untuk diinput kedalam tabel tertentu
                $arr[$t->name] = $post[$t->name];

                // variabel data secondary
                if ($t->type_name == 'date') {
                    $variable[$t->name] = tanggal($post[$t->name]);
                } else {
                    $variable[$t->name] = $post[$t->name];
                }
            }
        }

        $t = $this->model_template->get_by_id_permohonan($variable['tblizinpermohonan_id']);

        // insert ke tabel tertentu
        if (!$this->insert($tabel, $arr)) {

            $res = array('status' => false, 'msg' => 'Terjadi kesalahan saat menginput data ');
            return $this->response->setJSON($res);
        }

        $file_name = 'rekomendasi_' . $post['tblizinpendaftaran_id'] . '.docx';
        $path = 'doc/word/' . $file_name;
        $output = word_dir($file_name);

        // mencari template terkait
        $template = template_dir($t['tblskizin_rekomtemplate']);


        // jika template tidak ditemukan
        if (!file_exists($template)) {
            $res = array('status' => false, 'msg' => 'Template tidak ditemukan, harap hubungi administrator untuk membuatnya');
            return $this->response->setJSON($res);
        }

        // generate word by rtf template
        $this->model_doc->processRTFTemplate($template, $output, $variable);

        // generate ke pdf simpan ke server
        $res = $this->model_doc->word2pdf($output, 'doc/before_tte/');

        if (!isset($res)) {
            $res = array('status' => false, 'msg' => 'Terjadi kesalahan saat conversi file pdf');
            return $this->response->setJSON($res);
        }

        //    path pdf
        $path2 = base_url('doc/before_tte/' . $res);

        $r = $this->model_kendali_proses->get_by_status_4($post['tblizinpendaftaran_id']);
        $id = $r['tblkendaliproses_id'];

        $res = array('status' => true, 'msg' => 'Rekomendasi berhasil dicetak, lanjut melakukan tte', 'path' => $path2, 'url_file' => base_url($path), 'name_file' => $file_name);
        return $this->response->setJSON($res);
    }

    public function tte()
    {
        // id_pendaftaran
        $rekomendasi = $this->model_tte_rekomendasi->get_by_blok_sistem_id();
        $id_pendaftaran = $this->request->getPost('tblizinpendaftaran_id');

        // generate qr code
        $val = base_url('doc/sign/rekomendasi_' . $id_pendaftaran . '.pdf');
        $qr_path =  $this->model_doc->qrcode($val, qr_gen_dir());
        $qr = $this->model_doc->get_img($qr_path, array('width' => 3, 'height' => 3));




        // edit template
        $r = $this->model_pendaftaran->get_by_id($id_pendaftaran);

        // variabel data primary
        $variable['nama_pemohon'] = $r['tblizinpendaftaran_namapemohon'];
        $variable['tgl_permohonan'] = tanggal($r['tblizinpendaftaran_tgljam']);
        $variable['nama_usaha'] = $r['tblizinpendaftaran_usaha'];
        $variable['alamat_usaha'] = $r['tblizinpendaftaran_lokasiizin'];
        $variable['alamat_pemohon'] = $r['tblizinpendaftaran_almtpemohon'];
        $variable['izin'] = $r['tblizin_nama'];
        $variable['tblizinpermohonan_id'] = $r['tblizinpermohonan_id'];
        $variable['npwp'] = $r['tblizinpendaftaran_npwp'];
        $variable['nik'] = $r['tblizinpendaftaran_idpemohon'];

        // variabel tte
        $variable['qr_ttd'] = '';
        $variable['bsre_logo'] = '';
        $variable['TTD'] = $qr;
        $variable['nama_kadis'] = $rekomendasi['nama'];
        $variable['pangkat_kadis'] = $rekomendasi['pangkat'];
        $variable['nip_kadis'] = $rekomendasi['nip'];
        $variable['footer_ttd'] = footer_tte();

        $per = $this->model_persyaratan_pemohon->get_pas_foto($r['tblpemohon_id']);

        if ($per) {
            $dir =  'doc/persyaratan/' . $per['tblpemohonpersyaratan_file'];
            $pas_foto = $this->model_doc->get_img($dir, array('width' => 3, 'height' => 4));
            $variable['pas_foto'] = $pas_foto;
        }

        $id_permohonan = $variable['tblizinpermohonan_id'];
        $tabel_info = $this->get_table_info($id_permohonan);
        // mendapatkan tabel tertentu
        $tabel = $this->get_table($id_permohonan);




        // mendapatkan row dari tabel tertentu
        $arr =  $this->get_row($tabel, $id_pendaftaran);

        if (!$arr) {
            $res = array('status' => false, 'msg' => 'Rekomendasi belum dicetak');
            return $this->response->setJSON($res);
        }


        foreach ($tabel_info as $key => $t) {
            if ($key != 0) {


                // variabel data secondary
                if ($t->type_name == 'date') {
                    $variable[$t->name] = tanggal($arr[$t->name]);
                } else {
                    $variable[$t->name] = $arr[$t->name];
                }
            }
        }


        $t = $this->model_template->get_by_id_permohonan($variable['tblizinpermohonan_id']);


        $file_name = 'rekomendasi_' . $id_pendaftaran . '.docx';

        $output = word_dir($file_name);
        $template = base_url('doc/template/' . $t['tblskizin_rekomtemplate']);
        // edit template
        $this->model_doc->processRTFTemplate($template, $output, $variable);
        // convert jadi pdf
        $res = $this->model_doc->word2pdf($output, unsign());
        // tte
        $path = unsign($res);



        $nik = $rekomendasi['nik'];
        $passphrase = $this->request->getPost('passphrase');
        $res_tte = $this->model_doc->tte($id_pendaftaran, $path, $res, $nik, $passphrase);

        $res_tte_decode = json_decode($res_tte, true);


        // validasi tte 
        if (isset($res_tte_decode['error'])) {
            $res = array('status' => false, 'msg' => $res_tte_decode['error']);
            return $this->response->setJSON($res);
        }

        // ketika berhasil
        file_put_contents(sign('rekomendasi_' . $id_pendaftaran . '.pdf'), $res_tte);

        // insert proses berkas
        if (!$this->insert_proses($id_pendaftaran)) {
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }


        $r = $this->model_kendali_proses->get_by_status_4($id_pendaftaran);
        $id = $r['tblkendaliproses_id'];



        $res = array('status' => true, 'msg' => 'Berhasil di tanda tangani, lanjut kendali berkas', 'url' => site_url('kendali_berkas/form_page/' . $id));
        return $this->response->setJSON($res);
    }

    private function insert($t, $d)
    {
        $db = \Config\Database::connect();

        $query = $db->table($t)->where('tblizinpendaftaran_id', $d['tblizinpendaftaran_id'])->get();
        if ($query->getNumRows() > 0) {

            $u =  $db->table($t)->where('tblizinpendaftaran_id', $d['tblizinpendaftaran_id'])->update($d);

            if ($u) {
                return true;
            }
        } else {
            $i =  $db->table($t)->insert($d);
            if ($i) {
                return true;
            }
        }

        return false;
    }

    private function insert_proses($id_daftar)
    {

        $this->model_kendali_proses->where('tblizinpendaftaran_id', $id_daftar);
        $this->model_kendali_proses->where('tblkendalibloksistem_idasal', session()->blok_sistem_id);
        $r =  $this->model_kendali_proses->where('tblkendalibloksistemtugas_id', 3)->first();
        $time = date('Y-m-d H:i:s');
        if ($r) {
            $id = $r['tblkendaliproses_id'];
            $d['tblkendaliproses_tglselesai'] = $time;
            $d['tblkendaliproses_tglselesai_sys'] = $time;
            $d['tblkendaliproses_tglterima'] = $time;
            $d['tblpengguna_id'] = session()->id;
            $d['tblkendaliproses_catatan'] = 'Rekomendasi di cetak ulang';

            $u =  $this->model_kendali_proses->update($id, $d);

            if ($u) {
                return true;
            }
        } else {

            // insert kendali proses progres
            $d['tblizinpendaftaran_id'] = $id_daftar;
            // 3 adalah Penerbitan Naskah Perizinan
            $d['tblkendalibloksistemtugas_id'] = 49;
            $d['tblkendaliproses_tglmulai'] = $time;
            $d['tblkendaliproses_tglmulai_sys'] = $time;
            $d['tblkendaliproses_tglselesai'] = $time;
            $d['tblkendaliproses_tglselesai_sys'] = $time;
            // 5 adalah BO Usaha 1
            $d['tblkendalibloksistem_idasal'] =  session()->blok_sistem_id;
            // 5 adalah BO Usaha 1
            $d['tblkendalibloksistem_idkirim'] =  session()->blok_sistem_id;
            $d['tblkendaliproses_catatan'] = 'Rekomendasi telah dicetak';
            $d['tblkendaliproses_isparaf'] = 'T';
            $d['tblkendaliproses_isberkasfisikdikirim'] = 'T';
            $d['tblkendaliproses_tglberkasfisikdikirim'] = $time;
            $d['tblkendaliproses_tglberkasfisikdikirim_sys'] = $time;
            $d['tblkendaliproses_tglterima'] = $time;
            // 6 belum tahu ? apa itu 6 ihh ai lah
            $d['tblkendaliproses_status'] = 6;
            $d['tblpengguna_id'] = session()->id;

            $i = $this->model_kendali_proses->save($d);

            if ($i) {


                return true;
            }
        }

        return false;
    }

    private function get_row($t, $id)
    {
        $db = \Config\Database::connect();
        $row = $db->table($t)->where('tblizinpendaftaran_id', $id)->get()->getRowArray();

        if (!$row) {
            return false;
        }


        return $row;
    }

    private function get_table($id)
    {
        $db = \Config\Database::connect();
        $m = $db->table('v_template_rekomendasi');
        $m->where('tblizinpermohonan_id', $id);
        $r = $m->get()->getRowArray();

        if (!$r) {
            return false;
        }

        $m = $db->table('tblskizin_tabelvariabel');
        $m->where('tblskizin_tabelvariabel_id', $r['tblskizin_tabelvariabel_idrekom']);
        $r = $m->get()->getRowArray();


        return $r['tblskizin_tabelsk'];
    }

    private function get_table_info($id)
    {
        $table = $this->get_table($id);

        if (!$table) {
            return false;
        }
        $db = \Config\Database::connect();
        $query = $db->table($table)->get();

        $fields = $query->getFieldData();

        return $fields;
    }

    private function sk_terakhir($t)
    {
        $db = \Config\Database::connect();
        $m = $db->table($t);
        $m->select('no_izin');
        $m->orderBy('tgl_penetapan', 'DESC');
        $m->limit(1);

        $r = $m->get()->getRowArray();

        if (!$r) {
            return '';
        }

        return $r['no_izin'];
    }


    public function validasi_no_izin()
    {

        $t = $this->request->getPost('table');
        $no_izin = $this->request->getPost('no_izin');
        $tblizinpendaftaran_id = $this->request->getPost('tblizinpendaftaran_id');

        $db = \Config\Database::connect();
        $m = $db->table($t);
        $m->select('no_izin');
        $m->where('no_izin', $no_izin);
        $m->where('tblizinpendaftaran_id != ', $tblizinpendaftaran_id);

        $r = $m->get()->getNumRows();

        if (!$r) {
            $res = array('status' => true, 'msg' => 'Nomor dapat dipakai');
            return $this->response->setJSON($res);
        }

        $res = array('status' => false, 'msg' => 'Nomor tidak dapat dipakai');
        return $this->response->setJSON($res);
    }
}