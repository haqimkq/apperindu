<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Models\Master\M_blok_sistem_tugas;
use App\Controllers\BaseController;

class Blok_sistem_tugas extends BaseController
{
    private $page = 'Blok Sistem Tugas';
    private $url = 'blok_sistem_tugas';
    private $path = 'Master/blok_sistem_tugas';

    protected $model;
    protected $model_blok_sistem;
    protected $request;
    protected $primaryKey = 'tblkendalibloksistemtugas_id';

    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_blok_sistem_tugas($this->request);
    }
    public function index()
    {
        $this->model_blok_sistem =  new \App\Models\Master\M_blok_sistem($this->request);
        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['blok_sistem'] = $this->model_blok_sistem->findAll();
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
            $row[] = '<input type="checkbox" name="id[]" value="' . $l[$this->primaryKey] . '" class="bulk">';
            $row[] = '
                <div class="btn-group">
                <button type="button"
                    class="btn  btn-sm btn-outline-primary"  onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</button>
                <button type="button"
                    class="btn btn-sm btn-outline-primary" onclick="update(\'' . $l[$this->primaryKey] . '\')">Edit</button>
            </div>';


            $row[] = $l['tblkendalibloksistem_nama'];
            $row[] = $l['tblkendalibloksistemtugas_nama'];
            $row[] = status_aktif($l['tblkendalibloksistemtugas_isaktif']);
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
            'tblkendalibloksistem_id' => 'required',
            'tblkendalibloksistemtugas_nama' => 'required',
            'tblkendalibloksistemtugas_isaktif' => 'required',
        ];


        $id = $this->request->getPost('id');

        foreach ($this->model->allowedfields() as $r) {
            $d[$r] = $this->request->getPost($r);
        }

        // dd($d);

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

    public function form_bulk()
    {
        $opsi = $this->request->getPost('bulk_opsi');

        $id = $this->request->getPost('id');


        foreach ($id as $r) {

            if ($opsi == 1) {
                $d['tblkendalibloksistemtugas_isaktif'] = 'T';
                $this->model->update($r, $d);
            } else if ($opsi == 2) {
                $d['tblkendalibloksistemtugas_isaktif'] = 'F';
                $this->model->update($r, $d);
            } else {
                $this->model->delete($r);
            }
        }

        session()->setFlashdata('success', success_bulk());
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