<?php

namespace App\Controllers;

use App\Models\Api\MJwt;

class Login extends BaseController
{

    private $page = 'Halaman Login';
    private $url = 'login';

    public function index()
    {


        if ($this->session->status) {
            return redirect()->to('/dashboard');
        }


        $data['title'] = $this->page;

        $data['url'] = $this->url;
        return view('login', $data);
    }

    public function  form()
    {
        $model = new MJwt();
        $token = $model->get_token();
        $token = json_decode($token, true);


        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');


        if (!isset($token['status'])) {
            $response = [
                'status' => false,
                'msg' => 'Tidak dapat mendapatkan token'

            ];


            return $this->response->setJSON($response);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => site_url('login_api'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "username" : "' . $username . '",
            "password" : "' . $password . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token['token']
            ),
        ));

        $res = curl_exec($curl);
        $res = json_decode($res, true);

        if (!$res['status']) {
            $response = [
                'status' => false,
                'msg' => $res['msg']

            ];


            return $this->response->setJSON($response);
        }

        $session = session();

        $newdata = [
            'status'  => true,
            'id'     => $res['id'],
            'nama' => $res['nama'],
            'blok_sistem_id' => $res['blok_sistem_id'],
            'blok_sistem' => $res['blok_sistem'],
        ];

        $session->set($newdata);

        $url = 'pendaftaran';
        if ($res['blok_sistem_id'] == 99) {
            $url = 'izin';
        }

        if (in_array($res['blok_sistem_id'], get_blok_sistem_type_5())) {

            $url = 'validasi';
        }

        if ($res['blok_sistem_id'] == 127) {
            $url = 'tte/view/berkas';
        }

        $response = [
            'status' => true,
            'msg' => $res['msg'],
            'url' => site_url($url)

        ];


        return $this->response->setJSON($response);
    }
}
