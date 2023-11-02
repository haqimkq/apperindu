<?php

namespace App\Controllers\Api;

use App\Models\M_kendali_proses;
use App\Models\M_pemohon;
use App\Models\M_pendaftaran;
use App\Models\M_persyaratan_pemohon;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Master\M_pengguna;
use App\Models\Master\M_persyaratan_permohonan;
use Config\Services;

class Permohonan extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use ResponseTrait;
    protected $model;
    protected $model_kendali_proses;
    protected $model_pemohon;
    protected $model_pengguna;
    protected $model_persyaratan;
    protected $model_persyaratan_pemohon;
    protected $primaryKey = 'tblizinpendaftaran_id';

    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_pendaftaran($this->request);
        $this->model_kendali_proses = new M_kendali_proses($this->request);
        $this->model_pemohon = new M_pemohon($this->request);
        $this->model_pengguna = new M_pengguna($this->request);
        $this->model_persyaratan = new M_persyaratan_permohonan($this->request);
        $this->model_persyaratan_pemohon = new M_persyaratan_pemohon($this->request);
    }


    public function index()
    {

        helper('app_helper');
        $rules = [
            'tblizinpendaftaran_nomor' => 'required',

        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        $nomor = $this->request->getVar('tblizinpendaftaran_nomor');
        $row = $this->model->get_by_pendaftaran_nomor($nomor);

        if (!$row) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }
        $row['tgl_daftar'] = tanggal($row['tblizinpendaftaran_tgljam']);
        $row['status'] = status_pendaftaran($row['tblizinpendaftaran_issign']);
        $log =  $this->model_kendali_proses->get_by_id_pendaftaran($row[$this->primaryKey]);

        if (!$log) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }

        $rows = array();
        foreach ($log as $r) {

            $r['tgl_mulai'] = tanggal($r['tblkendaliproses_tglmulai']);
            $r['tgl_selesai'] = tanggal($r['tblkendaliproses_tglselesai']);
            $r['tgl_berkas'] = tanggal($r['tblkendaliproses_tglberkasfisikdikirim']);
            $r['status'] = status_kendali_berkas($r['tblkendaliproses_status']);
            $rows[] = $r;
        }



        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'pendaftaran' => $row,
            'log' => $rows
        ];

        return $this->response->setJSON($response);
    }

    public function get_by_id_pendaftaran()
    {

        helper('app_helper');
        $rules = [
            'tblizinpendaftaran_id' => 'required',

        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        $id = $this->request->getVar('tblizinpendaftaran_id');
        $row = $this->model->get_by_id($id);

        if (!$row) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }
        $row['tgl_daftar'] = tanggal($row['tblizinpendaftaran_tgljam']);
        $row['status'] = status_pendaftaran($row['tblizinpendaftaran_issign']);
        $log =  $this->model_kendali_proses->get_by_id_pendaftaran($row[$this->primaryKey]);

        if (!$log) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }

        $rows = array();
        foreach ($log as $r) {

            $r['tgl_mulai'] = tanggal($r['tblkendaliproses_tglmulai']);
            $r['tgl_selesai'] = tanggal($r['tblkendaliproses_tglselesai']);
            $r['tgl_berkas'] = tanggal($r['tblkendaliproses_tglberkasfisikdikirim']);
            $r['status'] = status_kendali_berkas($r['tblkendaliproses_status']);
            $rows[] = $r;
        }



        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => array('pendaftaran' => $row, 'log' => $rows),

        ];

        return $this->response->setJSON($response);
    }

    public function get_by_id_pemohon()
    {

        helper('app_helper');
        $rules = [
            'tblpemohon_id' => 'required',

        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        $id = $this->request->getVar('tblpemohon_id');
        $row = $this->model->get_by_id_pemohon($id);

        if (!$row) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }

        $pen = array();
        foreach ($row as $r) {
            $r['tgl_daftar'] = tanggal($r['tblizinpendaftaran_tgljam']);
            $r['status'] = $r['status_online'];
            $pen[] =  $r;
        }

        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => $pen,

        ];

        return $this->response->setJSON($response);
    }

    public function get_pemohon()
    {

        helper('app_helper');
        $rules = [
            'tblpengguna_id' => 'required',

        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        $id = $this->request->getVar('tblpengguna_id');
        $row = $this->model_pemohon->get_by_pengguna_id($id);

        if (!$row) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }



        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => $row,

        ];

        return $this->response->setJSON($response);
    }

    public function update_pemohon()
    {
        $arr  = [
            'tblpemohon_nama',
            'tblpemohon_alamat',
            'tblpemohon_noidentitas',
            'tblpemohon_npwp',
            'tblpemohon_telpon',
            'tblpemohon_email',
        ];

        $rules = [
            'tblpemohon_id' => 'required',
            'tblpemohon_noidentitas' => 'required',
            'tblpemohon_nama' => 'required',
            'tblpemohon_alamat' => 'required',
            'tblpemohon_npwp' => 'required',
            'tblpemohon_telpon' => 'required',
            'tblpemohon_email' => 'required'
        ];


        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        foreach ($arr as $r) {
            $d[$r] = $this->request->getVar($r);
        }

        $id =  $this->request->getVar('tblpemohon_id');
        if (!$this->model_pemohon->update($id, $d)) {

            $response = [
                'status' => false,
                'msg' => 'Terjadi kesalahan',

            ];

            return $this->response->setJSON($response);
        }


        $response = [
            'status' => true,
            'msg' => 'Berhasil tersimpan',
            'data' => $d

        ];

        return $this->response->setJSON($response);
    }


    public function pernah_daftar()
    {
        $jenis = $this->request->getVar('jenis');
        $npwp = $this->request->getVar('tblpemohon_npwp');
        $nik = $this->request->getVar('tblpemohon_noidentitas');

        if ($jenis == 1) {

            if (!$npwp) {
                $response = [
                    'status' => false,
                    'msg' => 'Form tidak lengkap',

                ];

                return $this->response->setJSON($response);
            }

            $this->model_pemohon->where('tblpemohon_npwp', $npwp);
            $username = $npwp;
        } else {
            if (!$nik) {
                $response = [
                    'status' => false,
                    'msg' => 'Form tidak lengkap',

                ];

                return $this->response->setJSON($response);
            }
            $this->model_pemohon->where('tblpemohon_noidentitas', $nik);
            $username = $nik;
        }


        $row =  $this->model_pemohon->first();

        if (!$row) {
            $response = [
                'status' => true,
                'msg' => 'Nomor tersedia',
                'username' => $username
            ];

            return $this->response->setJSON($response);
        }

        $response = [
            'status' => false,
            'msg' => 'Sudah pernah mendaftar',
            'data' => array(
                'nama' => $row['tblpemohon_nama'],
                'telpon' => $row['tblpemohon_telpon'],
                'email' => $row['tblpemohon_email']
            )
        ];

        return $this->response->setJSON($response);
    }

    public function daftar_akun()
    {

        $d2['username'] = $this->request->getVar('username');
        $d2['tblpengguna_nama'] = $this->request->getVar('tblpemohon_nama');
        $d2['tblpengguna_password'] =  password_hash($this->request->getVar('tblpengguna_password'), PASSWORD_DEFAULT);
        $d2['tblkendalibloksistem_id'] = 12;

        $in = $this->model_pengguna->save($d2);

        if (!$in) {

            $response = [
                'status' => false,
                'msg' => 'Terjadi kesalahan',

            ];

            return $this->response->setJSON($response);
        }



        foreach ($this->model_pemohon->allowedfields() as $r) {
            $d[$r] = $this->request->getVar($r);
        }

        $d['refjenisidentitas_id'] = 1;
        $d['tblpemohon_idonline'] = $this->id_online();
        $d['tblpengguna_id'] = $this->model_pengguna->getInsertID();
        $d['tblpemohon_finger'] = "";

        $in = $this->model_pemohon->save($d);

        if (!$in) {

            $response = [
                'status' => false,
                'msg' => 'Terjadi ',

            ];

            return $this->response->setJSON($response);
        }


        $response = [
            'status' => true,
            'msg' => 'Berhasil terdaftar',
            'pemohon' => $d,
            'pengguna' => $d2

        ];



        return $this->response->setJSON($response);
    }

    public function get_persyaratan()
    {

        $id = $this->request->getVar('id_permohonan');
        $id_pemohon = $this->request->getVar('id_pemohon');

        $rules = [
            'id_permohonan' => 'required',

        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }


        $rows =   $this->model_persyaratan->get_persyaratan_by_id_permohonan($id)->get()->getResultArray();
        $arr = array();
        foreach ($rows as $r) {
            $r['file'] = null;
            if ($id_pemohon) {
                $r['file'] = $this->get_persyaratan_pemohon($id_pemohon, $r['tblpersyaratan_id']);
            }

            $arr[] = $r;
        }

        if (!$arr) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan',
                'data' => []

            ];

            return $this->response->setJSON($response);
        }

        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => $arr

        ];

        return $this->response->setJSON($response);
    }

    private function get_persyaratan_pemohon($id_pemohon, $id_persyaratan)
    {

        $row = $this->model_persyaratan_pemohon->get_by_id_pemohon_and_persyaratan($id_pemohon, $id_persyaratan);

        if ($row) {
            return $row['tblpemohonpersyaratan_file'];
        }

        return null;
    }

    public function login()
    {


        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        $user = $this->model_pengguna->get_by_username($this->request->getVar('username'));

        if (!$user) {
            $response = [
                'status' => false,
                'msg' => 'Username atau password salah'

            ];

            return $this->response->setJSON($response);
        }

        $verify  = password_verify($this->request->getVar('password'), $user['tblpengguna_password']);
        if (!$verify) {

            $response = [
                'status' => false,
                'msg' => 'Username atau password salah'

            ];

            return $this->response->setJSON($response);
        }

        $row = $this->model_pemohon->get_by_pengguna_id($user['tblpengguna_id']);

        $response = [
            'status' => true,
            'msg' => 'Username ditemukan',
            'id' =>  $user['tblpengguna_id'],
            'nama' => $user['tblpengguna_nama'],
            'tblpemohon_id' =>  $row['tblpemohon_id'],
            'no_identitas' => $row['tblpemohon_noidentitas'],
            'alamat' => $row['tblpemohon_alamat'],
            'telepon' => $row['tblpemohon_telpon'],
            'email' => $row['tblpemohon_email'],
            'npwp' => $row['tblpemohon_npwp'],

        ];

        return $this->response->setJSON($response);
    }


    private function id_online()
    {
        $this->model_pemohon->selectMax('tblpemohon_idonline');
        $row = $this->model_pemohon->first();

        return $row['tblpemohon_idonline'];
    }

    public function testing()
    {
        $file = $this->request->getFile('file');
        $file->move('doc/');
    }
}
