<?php

namespace App\Controllers;

use App\Models\M_doc;
use App\Models\M_kendali_proses;
use App\Models\M_pendaftaran;
use App\Models\M_pengaturan;
use App\Models\M_persyaratan_pemohon;
use App\Models\Master\M_template;
use Config\Services;

class Tte extends BaseController
{

    private $page = 'Berkas TTE';
    private $url = 'tte';
    private $path = 'tte';

    protected $model;
    protected $model_pendaftaran;
    protected $model_pengaturan;
    protected $model_doc;
    protected $model_persyaratan_pemohon;
    protected $primaryKey = 'tblizinpendaftaran_id';
    protected $model_blok_sistem_tugas;
    protected $model_kendali_proses;
    protected $request;

    public function __construct()
    {
        $this->request = Services::request();
        $this->model = new M_kendali_proses($this->request);
        $this->model_pendaftaran =  new M_pendaftaran($this->request);
        $this->model_doc = new M_doc();
        $this->model_template = new M_template($this->request);
        $this->model_persyaratan_pemohon = new M_persyaratan_pemohon($this->request);
        $this->model_kendali_proses = new M_kendali_proses($this->request);
        $this->model_pengaturan = new M_pengaturan();
    }


    public function view($str)
    {



        $this->page = $this->page . ' ' . $this->name_it($str);
        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url . '/view/' . $str;
        $data['path'] = $this->path;
        $data['str'] = $str;

        return view($this->path . '/view', $data);
    }

    private function name_it($str)
    {
        if ($str == 'berkas_mandiri') {
            return 'Layanan Mandiri';
        }

        if ($str == 'sudah') {
            return 'Sudah Di Tanda Tangani';
        }

        return '';
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

            if ($str != 'sudah') {
                $opsi .= '<li><a class="dropdown-item"  href="' . site_url($this->url . '/form_page/' . $l[$this->primaryKey]) . '">Tanda Tangani</a>
                    </li>';
            } else {

                $before = base_url('doc/before_tte/' . $l[$this->primaryKey] . '.pdf');
                $opsi .= '<li><a class="dropdown-item"  href="#" onclick="review(\'' . $before . '\')">Sebelum TTE</a>
                </li>';
                $after = base_url('doc/sign/' . $l[$this->primaryKey] . '.pdf');
                $opsi .= '<li><a class="dropdown-item"  href="#" onclick="review(\'' . $after . '\')">Sesudah TTE</a>
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

    public function form()
    {
        // id_pendaftaran
        $id_pendaftaran = $this->request->getPost('tblizinpendaftaran_id');
        // generate qr code
        $encrypted_id = $this->model_doc->encrypt($id_pendaftaran, key_secret());

        $val = site_url('verify/verify_by_qr/' . $encrypted_id);
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
        $variable['npwp'] = $r['tblizinpendaftaran_npwp'];
        $variable['nik'] = $r['tblizinpendaftaran_idpemohon'];
        $variable['tblizinpermohonan_id'] = $r['tblizinpermohonan_id'];

        // variabel tte
        $variable['qr_ttd'] = '';
        $variable['bsre_logo'] = '';
        $variable['TTD'] = $qr;
        $variable['nama_kadis'] = nama_kadis();
        $variable['pangkat_kadis'] = pangkat_kadis();
        $variable['nip_kadis'] = nip_kadis();
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
            $res = array('status' => false, 'msg' => 'SK belum dicetak');
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


        $file_name = $id_pendaftaran . '.docx';

        $output = word_dir($file_name);
        $template = base_url('doc/template/' . $t['tblskizin_sktemplate']);
        // edit template
        $this->model_doc->processRTFTemplate($template, $output, $variable);
        // convert jadi pdf
        $res = $this->model_doc->word2pdf($output, unsign());
        // tte
        $path = unsign($res);

        $passphrase = $this->request->getPost('passphrase');
        $peng = $this->model_pengaturan->get_row();
        $nik = $peng['nik_kadis'];
        $res_tte = $this->model_doc->tte($id_pendaftaran, $path,  $res, $nik, $passphrase);

        $res_tte_decode = json_decode($res_tte, true);


        // validasi tte 

        if (isset($res_tte_decode['error'])) {
            $res = array('status' => false, 'msg' => $res_tte_decode['error']);
            return $this->response->setJSON($res);
        }

        // ketika berhasil

        file_put_contents(sign($id_pendaftaran . '.pdf'), $res_tte);

        // update data sudah tte
        $d['tblizinpendaftaran_issign'] = 'T';
        $d['tblizinpendaftaran_tglsign'] = date('Y-m-d H:i:s');
        $d['status_online'] = 4;

        $u =  $this->model_pendaftaran->update($id_pendaftaran, $d);

        if (!$u) {
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }


        $number = $r['tblizinpendaftaran_telponpemohon'];

        if ($number) {
            $row = $this->model_pengaturan->get_row();
            $variable['nama_pemohon'] = $r['tblizinpendaftaran_namapemohon'];
            $variable['tgl_permohonan'] = tanggal($r['tblizinpendaftaran_tgljam']);
            $variable['nama_usaha'] = $r['tblizinpendaftaran_usaha'];
            $variable['alamat_usaha'] = $r['tblizinpendaftaran_lokasiizin'];
            $variable['alamat_pemohon'] = $r['tblizinpendaftaran_almtpemohon'];
            $variable['npwp'] = $r['tblizinpendaftaran_npwp'];
            $variable['nik'] = $r['tblizinpendaftaran_idpemohon'];
            $variable['no_pendaftaran'] = $r['tblizinpendaftaran_nomor'];
            $variable['link_dokumen_digital'] =  base_url('permohonan/dokumen/' . $this->model_doc->encrypt($r['tblizinpendaftaran_id'], key_secret()));
            $msg = $this->model_pengaturan->replaceTemplateVariables($row['redaksi_tte'], $variable);

            $this->model_doc->send_wa($msg, $number, $row['token_wa']);
        }


        // insert proses berkas
        if (!$this->insert_proses($id_pendaftaran)) {
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        $res = array('status' => true, 'msg' => 'Berhasil di tanda tangani');
        return $this->response->setJSON($res);
    }


    public function send_wa($msg, $number)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://egov.abn-tala.my.id/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('message' => $msg, 'number' => $number),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
    }

    private function insert_proses($id_daftar)
    {


        $time = date('Y-m-d H:i:s');
        // insert kendali proses progres
        $d['tblizinpendaftaran_id'] = $id_daftar;
        // 51 adalah Penerbitan Naskah Perizinan
        $d['tblkendalibloksistemtugas_id'] = 51;
        $d['tblkendaliproses_tglmulai'] = $time;
        $d['tblkendaliproses_tglmulai_sys'] = $time;
        $d['tblkendaliproses_tglselesai'] = $time;
        $d['tblkendaliproses_tglselesai_sys'] = $time;

        $d['tblkendalibloksistem_idasal'] =  session()->blok_sistem_id;

        $d['tblkendalibloksistem_idkirim'] =  session()->blok_sistem_id;
        $d['tblkendaliproses_catatan'] = 'Berkas sudah ditanda tangani';
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

    public function form_page($id)
    {
        $file_name =  $id . '.pdf';
        $path = before_tte($file_name);

        if (file_exists($path)) {
            $pdf = file_get_contents($path);
            $base64 = base64_encode($pdf);
        } else {

            // get row
            $r = $this->model_pendaftaran->get_by_id($id);

            $tabel_info = $this->get_table_info($r['tblizinpermohonan_id']);
            // mendapatkan tabel tertentu
            $tabel = $this->get_table($r['tblizinpermohonan_id']);

            // mendapatkan row dari tabel tertentu
            $arr =  $this->get_row($tabel, $id);

            if (!$arr) {

                // jika tidak ada row perlu dicetak ulang

                $res = array('status' => false, 'msg' => 'SK belum dicetak');
                return $this->response->setJSON($res);
            }


            // variabel data primary
            $variable['nama_pemohon'] = $r['tblizinpendaftaran_namapemohon'];
            $variable['tgl_permohonan'] = tanggal($r['tblizinpendaftaran_tgljam']);
            $variable['nama_usaha'] = $r['tblizinpendaftaran_usaha'];
            $variable['alamat_usaha'] = $r['tblizinpendaftaran_lokasiizin'];
            $variable['alamat_pemohon'] = $r['tblizinpendaftaran_almtpemohon'];

            // variabel tte
            $variable['qr_ttd'] = '';
            $variable['bsre_logo'] = '';
            $variable['TTD'] = '';
            $variable['nama_kadis'] = nama_kadis();
            $variable['pangkat_kadis'] = pangkat_kadis();
            $variable['nip_kadis'] = nip_kadis();
            $variable['footer_ttd'] = '';


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


            // mendapatkan template terkait
            $t = $this->model_template->get_by_id_permohonan($r['tblizinpermohonan_id']);
            $file_name = $id . '.docx';

            // edit template
            $output = word_dir($file_name);
            $template = base_url('doc/template/' . $t['tblskizin_sktemplate']);

            // edit template
            $this->model_doc->processRTFTemplate($template, $output, $variable);

            // convert jadi pdf
            $res = $this->model_doc->word2pdf($output, before_tte());
            $path = before_tte($res);

            // pdf to base 64
            $pdf = file_get_contents($path);
            $base64 = base64_encode($pdf);
        }




        $r = $this->model_pendaftaran->get_by_id($id);
        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['request'] = $this->request;
        $data['r'] = $r;
        $data['base64'] = $base64;
        return view($this->path . '/form_page', $data);
    }



    private function get_table($id)
    {
        $db = \Config\Database::connect();
        $m = $db->table('v_template');
        $m->where('tblizinpermohonan_id', $id);
        $r = $m->get()->getRowArray();

        if (!$r) {
            return false;
        }

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

    public function before_tte($str)
    {



        // Path menuju file PDF
        $id = $this->model_doc->decrypt($str, key_secret());


        $path = before_tte($id . '.pdf');


        // Memeriksa keberadaan file PDF
        if (file_exists($path)) {
            // Mengambil tipe konten MIME dari file PDF
            $contentType = mime_content_type($path);

            // Membaca isi file PDF
            $pdfData = file_get_contents($path);

            // Mengonversi data PDF ke dalam bentuk base64
            $base64Pdf = base64_encode($pdfData);
            $embeddedPdf = 'data:' . $contentType . ';base64,' . $base64Pdf;

            $data['title'] = 'Sebelum TTE';
            $data['embeddedPdf'] =  $embeddedPdf;
            return view($this->path . '/pdf_view', $data);
        } else {
            // Menampilkan pesan jika file PDF tidak ditemukan
            echo 'File PDF tidak ditemukan.';
        }
    }


    public function after_tte($str)
    {



        // Path menuju file PDF
        $id = $this->model_doc->decrypt($str, key_secret());

        $path = sign($id . '.pdf');


        // Memeriksa keberadaan file PDF
        if (file_exists($path)) {
            // Mengambil tipe konten MIME dari file PDF
            $contentType = mime_content_type($path);

            // Membaca isi file PDF
            $pdfData = file_get_contents($path);

            // Mengonversi data PDF ke dalam bentuk base64
            $base64Pdf = base64_encode($pdfData);
            $embeddedPdf = 'data:' . $contentType . ';base64,' . $base64Pdf;

            $data['title'] = 'Dokumen';
            $data['embeddedPdf'] =  $embeddedPdf;
            return view($this->path . '/pdf_view', $data);
        } else {
            // Menampilkan pesan jika file PDF tidak ditemukan
            echo 'File PDF tidak ditemukan.';
        }
    }
}
