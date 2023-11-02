<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Models\Master\M_kelurahan;
use App\Controllers\BaseController;

class Kelurahan extends BaseController
{
    private $page = 'Kelurahan';
    private $url = 'kelurahan';
    private $path = 'Master/kelurahan';

    protected $model;
    protected $model_kecamatan;
    protected $request;
    protected $primaryKey = 'tblkelurahan_id';

    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_kelurahan($this->request);
    }

    public function index()
    {
        $this->model_kecamatan =  new \App\Models\Master\M_kecamatan($this->request);;
        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['kecamatan'] = $this->model_kecamatan->findAll();



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
            // $row[] = '<input type="checkbox" name="id[]" value="' . $l[$this->primaryKey] . '" class="bulk">';
            $row[] = '
                <div class="btn-group">
                <button type="button"
                    class="btn  btn-sm btn-outline-primary"  onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</button>
                <button type="button"
                    class="btn btn-sm btn-outline-primary" onclick="update(\'' . $l[$this->primaryKey] . '\')">Edit</button>
            </div>';
            // $row[] = $l['tblkecamatan_id'];
            $row[] = $l['tblkecamatan_nama'];
            $row[] = $l['tblkelurahan_nama'];
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


        $rules = [
            'tblkecamatan_id' => 'required',
            'tblkelurahan_nama' => 'required'
        ];

        $id = $this->request->getPost('id');

        foreach ($this->model->allowedfields() as $r) {
            $d[$r] = $this->request->getPost($r);
        }

        if ($this->validate($rules)) {
            if ($id) {
                $u =  $this->model->update($id, $d);

                if ($u) {
                    session()->setFlashdata('success', success_update());
                } else {
                    session()->setFlashdata('error', failed());
                }
            } else {
                $i =  $this->model->save($d);

                if ($i) {
                    session()->setFlashdata('success', success_add());
                } else {
                    session()->setFlashdata('error', failed());
                }
            }
        } else {
            session()->setFlashdata('error', failed());
        }






        return redirect()->to('/' . $this->url);
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

    public function get_row()
    {
        $id = $this->request->getPost('id');
        $row = $this->model->find($id);

        if ($row) {
            $response = array('status' => true, 'data' => $row);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'msg' =>  'Data tidak ditemukan');
            echo json_encode($response);
        }
    }
}