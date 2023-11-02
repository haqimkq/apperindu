<?php


namespace App\Controllers;


use App\Models\M_doc;
use App\Models\M_pendaftaran;
use Config\Services;


class Verify extends BaseController
{
    private $page = 'Verifikasi';
    private $url = 'verify';
    private $path = 'verify';

    protected $model_pendaftaran;
    protected $model_doc;
    protected $request;



    public function __construct()
    {
        $this->request = Services::request();
        $this->model_pendaftaran = new M_pendaftaran($this->request);
        $this->model_doc = new M_doc();
    }


    public function verify_by_qr($str)
    {


        $id = $this->model_doc->decrypt($str, key_secret());

        $pdf = sign($id . '.pdf');

        // cek file 
        if (!file_exists($pdf)) {

            $arr['status'] = false;
            $arr['msg'] = 'Dokumen tidak ditemukan';
            return $this->response->setJSON($arr);
        }


        $res = $this->model_doc->verify($pdf, 'doc.pdf');

        $res = json_decode($res, true);

        //  jika tidak valid
        if (!$res['details']) {

            $arr['status'] = false;
            $arr['msg'] = 'Dokumen tidak valid';
            return $this->response->setJSON($arr);
        }

        $detail = $res['details'][0];
        $arr['status'] = true;
        $arr['tgl_pindai'] = tanggal(date('Y-m-d'));
        $arr['tgl_penandatanganan'] = tanggal($detail['signature_document']['signed_in']);
        $arr['alasan'] =  $detail['signature_document']['reason'];
        $arr['penandatangan'] =  $detail['info_signer']['signer_name'];
        $arr['summary'] = $res['summary'];

        // mengambil data pendaftaran
        $r = $this->model_pendaftaran->get_by_id($id);
        $arr['tblizinpendaftaran_nomor'] = $r['tblizinpendaftaran_nomor'];
        $arr['tblizin_nama'] = $r['tblizin_nama'];
        $arr['tblizinpermohonan_nama'] = $r['tblizinpermohonan_nama'];
        $arr['tblizinpendaftaran_namapemohon'] = $r['tblizinpendaftaran_namapemohon'];
        $arr['no_izin'] = $this->get_row($id, $r['tblizinpermohonan_id']);
        $arr['dokumen'] = '<a target="_blank" href="' . base_url('download/public/' . $this->model_doc->encrypt($id, key_secret())) . '">Download</a>';
        $this->page = $this->page . 'Dengan Pindai ';
        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['r'] = $arr;
        return view($this->path . '/pindai', $data);
    }

    public function dokumen()
    {
        $this->page = $this->page . ' Dokumen ';
        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;


        return view($this->path . '/dokumen', $data);
    }

    public function form()
    {

        $rules = [
            'file' => [
                'rules' => 'uploaded[file]|ext_in[file,pdf]',
                'errors' => [
                    'uploaded' => 'Harap upload dokumen',
                    'ext_in' => 'Harap upload dokumen dengan format pdf'

                ]
            ],
        ];

        // validasi pdf
        if (!$this->validate($rules)) {


            $res = array('status' => false, 'msg' => $this->validator->getError('file'));
            return $this->response->setJSON($res);
        }


        // pindah ke directory temporary
        $file = $this->request->getFile('file');
        $file->move('doc/tmp');


        $pdf = tmp($file->getName());

        $res = $this->model_doc->verify($pdf, 'doc.pdf');


        $res = json_decode($res, true);


        // jika tidak valid

        if (!$res['details']) {

            $arr['status'] = false;
            $arr['msg'] = 'Dokumen tidak valid';
            return $this->response->setJSON($arr);
        }

        $detail = $res['details'][0];
        $arr['status'] = true;
        $arr['tgl_verifikasi'] = tanggal(date('Y-m-d'));
        $arr['tgl_penandatanganan'] = tanggal($detail['signature_document']['signed_in']);
        $arr['alasan'] =  $detail['signature_document']['reason'];
        $arr['penandatangan'] =  $detail['info_signer']['signer_name'];
        $arr['summary'] = $res['summary'];

        // mengambil data pendaftaran
        $id =  $detail['signature_document']['location'];
        $r = $this->model_pendaftaran->get_by_id($id);
        $arr['tblizinpendaftaran_nomor'] = $r['tblizinpendaftaran_nomor'];
        $arr['tblizin_nama'] = $r['tblizin_nama'];
        $arr['tblizinpermohonan_nama'] = $r['tblizinpermohonan_nama'];
        $arr['tblizinpendaftaran_namapemohon'] = $r['tblizinpendaftaran_namapemohon'];
        $arr['no_izin'] = $this->get_row($id, $r['tblizinpermohonan_id']);
        $arr['dokumen'] = '<a target="_blank" href="' . base_url('download/public/' . $this->model_doc->encrypt($id, key_secret())) . '">Download</a>';

        return $this->response->setJSON($arr);
    }


    private function get_row($id_pendaftaran, $id_permohonan)
    {

        $t = $this->get_table($id_permohonan);
        $db = \Config\Database::connect();
        $row = $db->table($t)->where('tblizinpendaftaran_id', $id_pendaftaran)->get()->getRowArray();

        if (!$row) {
            return '';
        }


        return $row['no_izin'];
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
}
