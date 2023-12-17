<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Models\Master\M_izin;
use App\Controllers\BaseController;
use App\Models\Master\M_blok_sistem;
use App\Models\Master\M_tte_rekomendasi;

class Tte_rekomendasi extends BaseController
{
    private $page = 'TTE Rekomendasi';
    private $url = 'tte_rekomendasi';
    private $path = 'Master/tte_rekomendasi';
    protected $model;
    protected $model_blok_sistem;
    protected $request;
    protected $primaryKey = 'id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_tte_rekomendasi($this->request);
        $this->model_blok_sistem = new M_blok_sistem($this->request);
    }

    public function index()
    {

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

            $row[] = '
            <div class="btn-group">
            <button type="button"
                class="btn  btn-sm btn-outline-primary"  onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</button>
            <button type="button"
                class="btn btn-sm btn-outline-primary" onclick="update(\'' . $l[$this->primaryKey] . '\')">Edit</button>
        </div>
            ';

            $row[] = $l['nik'];
            $row[] = $l['nip'];
            $row[] = $l['nama'];
            $row[] = $l['pangkat'];
            $row[] = $l['tblkendalibloksistem_nama'];
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
            'nik' => 'required',
            'nip' => 'required',
            'nama' => 'required',
            'pangkat' => 'required',
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