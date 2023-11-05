<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Master\M_pengguna;
use Config\Services;

class Login extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use ResponseTrait;
    protected $model;
    protected $primaryKey = 'tblpengguna_id';
    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_pengguna($this->request);
    }

    public function index()
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

        $user = $this->model->get_by_username($this->request->getVar('username'));

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

        $response = [
            'status' => true,
            'msg' => 'Username ditemukan',
            'id' =>  $user['tblpengguna_id'],
            'nama' => $user['tblpengguna_nama'],
            'blok_sistem_id' => $user['tblkendalibloksistem_id'],
            'blok_sistem' => $user['tblkendalibloksistem_nama']
        ];

        return $this->response->setJSON($response);
    }
}