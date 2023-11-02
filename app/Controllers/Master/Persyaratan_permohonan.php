<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Models\Master\M_persyaratan_permohonan;
use App\Controllers\BaseController;

class Persyaratan_permohonan extends BaseController
{
    private $page = 'Persyaratan Permohonan';
    private $url = 'persyaratan_permohonan';
    private $path = 'Master/persyaratan_permohonan';
    protected $model;
    protected $model_izin;
    protected $model_permohonan;
    protected $model_persyaratan;
    protected $request;
    protected $primaryKey = 'tblizinpersyaratan_id';

    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_persyaratan_permohonan($this->request);
        $this->model_permohonan =  new \App\Models\Master\M_permohonan($this->request);
    }


    public function index()
    {
        $this->model_izin =  new \App\Models\Master\M_izin($this->request);
        $this->model_persyaratan =  new \App\Models\Master\M_persyaratan($this->request);
        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['izin'] = $this->model_izin->findAll();
        $data['permohonan'] = $this->model_permohonan->findAll();
        $data['persyaratan'] = $this->model_persyaratan->findAll();

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
            </div>
            ';


            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblpersyaratan_nama'] . '</div>';
            $row[] = $l['tblizinpersyaratan_urut'];
            $row[] = status_aktif($l['tblizinpersyaratan_isaktif']);

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
            'tblizin_id' => 'required',
            'tblizinpermohonan_id' => 'required',
            'tblpersyaratan_id' => 'required',
            'tblizinpersyaratan_urut' => 'required',
            'tblizinpersyaratan_isaktif' => 'required'
        ];


        $id = $this->request->getPost('id');

        foreach ($this->model->allowedfields() as $r) {
            $d[$r] = $this->request->getPost($r);
        }



        if (!$this->validate($rules)) {
            $res = array('status' => false, 'msg' => 'Form tidak lengkap');
            return $this->response->setJSON($res);
        }
        if ($id) {
            $u =  $this->model->update($id, $d);

            if ($u) {
                // session()->setFlashdata('success', success_update());
                $res = array('status' => true, 'msg' => success_update());
                return $this->response->setJSON($res);
            }
        } else {
            $i =  $this->model->save($d);

            if ($i) {
                $res = array('status' => true, 'msg' => success_add());
                return $this->response->setJSON($res);
            }
        }

        $res = array('status' => false, 'msg' => failed());
        return $this->response->setJSON($res);
    }

    public function form_bulk()
    {
        $opsi = $this->request->getPost('bulk_opsi');

        $id = $this->request->getPost('id');


        foreach ($id as $r) {

            if ($opsi == 1) {
                $d['tblizinpersyaratan_isaktif'] = 'T';
                $this->model->update($r, $d);
            } else if ($opsi == 2) {
                $d['tblizinpersyaratan_isaktif'] = 'F';
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

    public function get_permohonan_by_id_izin_json()
    {
        // $this->model_permohonan = new \App\Models\Master\M_permohonan($this->request);
        $id = $this->request->getPost('id_izin');
        $rows = $this->model_permohonan->get_permohonan_by_id_izin($id)->get()->getResultArray();


        if ($rows) {
            $response = array('status' => true, 'data' => $rows);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'msg' =>  'Data tidak ditemukan');
            echo json_encode($response);
        }
        // return $m->where($this->primaryKey, $id);
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