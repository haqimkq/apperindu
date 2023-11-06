<?php

namespace App\Controllers\Api;

use App\Models\M_kendali_proses;
use App\Models\M_pemohon;
use App\Models\M_pendaftaran;
use App\Models\M_persyaratan_pemohon;
use App\Models\Master\M_izin;
use App\Models\Master\M_kecamatan;
use App\Models\Master\M_kelurahan;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Master\M_pengguna;
use App\Models\Master\M_permohonan;
use App\Models\Master\M_persyaratan_permohonan;
use Config\Services;

class Perizinan extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use ResponseTrait;
    protected $model;
    protected $model_permohonan;
    protected $model_persyaratan;
    protected $model_persyaratan_pemohon;
    protected $model_pengguna;
    protected $model_pemohon;
    protected $model_kecamatan;
    protected $model_kelurahan;
    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_izin($this->request);
        $this->model_permohonan = new M_permohonan($this->request);
        $this->model_persyaratan = new M_persyaratan_permohonan($this->request);
        $this->model_pengguna = new M_pengguna($this->request);
        $this->model_kendali_proses = new M_kendali_proses($this->request);
        $this->model_pemohon = new M_pemohon($this->request);
        $this->model_kecamatan = new M_kecamatan($this->request);
        $this->model_kelurahan = new M_kelurahan($this->request);
        $this->model_persyaratan_pemohon = new M_persyaratan_pemohon($this->request);
    }


    public function daftar_izin()
    {

        $rows = $this->model->get_data();

        if (!$rows) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }


        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => $rows
        ];

        return $this->response->setJSON($response);
    }

    public function daftar_permohonan()
    {
        $rules = [
            'tblizin_id' => 'required',

        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        $id = $this->request->getVar('tblizin_id');
        $rows = $this->model_permohonan->get_permohonan_by_id_izin($id)->get()->getResultArray();


        if (!$rows) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }


        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => $rows
        ];

        return $this->response->setJSON($response);
    }

    public function daftar_persyaratan()
    {

        $rules = [
            'tblizinpermohonan_id' => 'required',

        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        $id = $this->request->getVar('tblizinpermohonan_id');

        $rows = $this->model_persyaratan->get_persyaratan_by_id_permohonan($id)->get()->getResultArray();


        if (!$rows) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }


        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => $rows
        ];

        return $this->response->setJSON($response);
    }


    public function daftar_kecamatan()
    {
        $rows = $this->model_kecamatan->findAll();

        if (!$rows) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }


        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => $rows
        ];

        return $this->response->setJSON($response);
    }

    public function daftar_kelurahan()
    {
        $rules = [
            'id_kecamatan' => 'required',

        ];

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => 'Form tidak lengkap atau terjadi kesalahan pada form'

            ];

            return $this->response->setJSON($response);
        }

        $id = $this->request->getVar('id_kecamatan');
        $rows = $this->model_kelurahan->get_by_id_kecamatan($id)->get()->getResultArray();


        if (!$rows) {
            $response = [
                'status' => false,
                'msg' => 'Data tidak ditemukan'

            ];

            return $this->response->setJSON($response);
        }


        $response = [
            'status' => true,
            'msg' => 'Data ditemukan',
            'data' => $rows
        ];

        return $this->response->setJSON($response);
    }
}
