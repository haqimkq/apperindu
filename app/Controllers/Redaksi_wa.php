<?php

namespace App\Controllers;

use App\Models\M_doc;
use App\Models\M_pengaturan;

class Redaksi_wa extends BaseController
{

    private $page = 'Redaksi';
    private $url = 'redaksi_wa';
    private $path = 'redaksi_wa';

    protected $model;
    protected $model_doc;


    public function __construct()
    {

        $this->model =  new M_pengaturan();
        $this->model_doc = new M_doc();
    }


    public function ditolak()
    {

        $data['title'] = 'Redaksi Notif WA Ditolak';
        $data['page'] = 'Redaksi Notif WA Ditolak';
        $data['url'] = $this->url . '/ditolak';
        $data['path'] = $this->path;
        $data['r'] = $this->model->get_row();

        return view($this->path . '/ditolak', $data);
    }

    public function diterima()
    {

        $data['title'] = 'Redaksi Notif WA Diterima';
        $data['page'] = 'Redaksi Notif WA Diterima';
        $data['url'] = $this->url . '/diterima';
        $data['path'] = $this->path;
        $data['r'] = $this->model->get_row();

        return view($this->path . '/diterima', $data);
    }

    public function sudah_tte()
    {

        $data['title'] = 'Redaksi Notif WA Sudah Tanda Tangan';
        $data['page'] = 'Redaksi Notif WA Sudah Tanda Tangan';
        $data['url'] = $this->url . '/sudah_tte';
        $data['path'] = $this->path;
        $data['r'] = $this->model->get_row();

        return view($this->path . '/sudah_tte', $data);
    }



    public function form()
    {
        $id = $this->request->getPost('id');
        $arr    = [
            'redaksi_ditolak',
            'redaksi_diterima',
            'redaksi_tte',
            'wa_testing'
        ];

        foreach ($arr as $r) {
            if ($this->request->getPost($r)) {
                $d[$r] = $this->request->getPost($r);
            }
        }

        $u =  $this->model->update($id, $d);

        if (!$u) {
            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        $res = array('status' => true, 'msg' => success_update());
        return $this->response->setJSON($res);
    }

    public function form_testing()
    {
        $arr = [
            'redaksi_ditolak',
            'redaksi_diterima',
            'redaksi_tte',
            'wa_testing'
        ];



        foreach ($arr as $key =>  $r) {

            if ($this->request->getPost($r)) {
                $d[$r] = $this->request->getPost($r);

                if ($d[$r] &&  $r != 'wa_testing') {
                    $val = $r;
                }
            }
        }


        $data = $this->model->variable_dummy();
        $msg = $this->model->replaceTemplateVariables($d[$val], $data);

        $r = $this->model->get_row();
        $token = $r['token_wa'];
        $this->model_doc->send_wa($msg, $d['wa_testing'], $token);

        $res = array('status' => true, 'msg' => 'Notifikasi Terkirim');
        return $this->response->setJSON($res);
    }
}
