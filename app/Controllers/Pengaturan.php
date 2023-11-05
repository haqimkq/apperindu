<?php

namespace App\Controllers;

use App\Models\M_pengaturan;

class Pengaturan extends BaseController
{

    private $page = 'Pengaturan';
    private $url = 'pengaturan';
    private $path = 'pengaturan';

    protected $model;



    public function __construct()
    {

        $this->model =  new M_pengaturan();
    }


    public function form_page()
    {

        $data['title'] = 'Pengaturan Pimpinan';
        $data['page'] = 'Pengaturan Pimpinan';
        $data['url'] = $this->url . '/form_page';
        $data['path'] = $this->path;
        $data['r'] = $this->model->get_row();

        return view($this->path . '/form_page', $data);
    }


    public function token()
    {

        $data['title'] =  'Pengaturan Token';
        $data['page'] = 'Pengaturan Token';
        $data['url'] = $this->url . '/token';
        $data['path'] = $this->path;
        $data['r'] = $this->model->get_row();

        return view($this->path . '/token', $data);
    }

    public function form()
    {
        $id = $this->request->getPost('id');
        $arr    = [
            'nip_kadis',
            'nik_kadis',
            'nama_kadis',
            'pangkat_kadis'
        ];

        foreach ($arr as $r) {
            $d[$r] = $this->request->getPost($r);
        }

        $u =  $this->model->update($id, $d);

        if (!$u) {
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        $res = array('status' => true, 'msg' => success_update());
        return $this->response->setJSON($res);
    }

    public function form_token()
    {
        $id = $this->request->getPost('id');
        $arr    = [
            'token_wa',
            'token_tte'
        ];

        foreach ($arr as $r) {
            $d[$r] = $this->request->getPost($r);
        }

        $u =  $this->model->update($id, $d);

        if (!$u) {
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        $res = array('status' => true, 'msg' => success_update());
        return $this->response->setJSON($res);
    }
}
