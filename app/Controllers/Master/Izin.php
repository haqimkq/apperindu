<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Models\Master\M_izin;
use App\Controllers\BaseController;

class Izin extends BaseController
{
    private $page = 'Izin';
    private $url = 'izin';
    private $path = 'Master/izin';
    protected $model;
    protected $model_permohonan;
    protected $request;
    protected $primaryKey = 'tblizin_id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_izin($this->request);
    }

    public function index()
    {

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;

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
            $row[] = '<a href="#" onclick="lihat_permohonan(\'' . $l[$this->primaryKey] . '\')">Lihat (' . $this->get_permohonan_by_id_izin($l[$this->primaryKey])->countAllResults() . ')</a>';
            $row[] = $l['tblizin_nama'];
            $row[] = status_aktif($l['tblizin_isaktif']);
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
            'tblizin_nama' => 'required',
            'tblizin_isaktif' => 'required'
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

    public function form_bulk()
    {
        $opsi = $this->request->getPost('bulk_opsi');

        $id = $this->request->getPost('id');


        foreach ($id as $r) {

            if ($opsi == 1) {
                $d['tblizin_isaktif'] = 'T';
                $this->model->update($r, $d);
            } else if ($opsi == 2) {
                $d['tblizin_isaktif'] = 'F';
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

    public function get_permohonan()
    {

        $id = $this->request->getPost('id');
        $data['rows'] = $this->get_permohonan_by_id_izin($id)->get()->getResultArray();
        return view($this->path . '/tabel_permohonan', $data);
    }

    public function get_permohonan_by_id_izin($id)
    {
        $this->model_permohonan = new \App\Models\Master\M_permohonan($this->request);
        return $this->model_permohonan->get_permohonan_by_id_izin($id);
        // return $m->where($this->primaryKey, $id);
    }
}
