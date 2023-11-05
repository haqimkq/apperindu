<?php

namespace App\Controllers\Master;


use Config\Services;
use App\Models\Master\M_permohonan;
use App\Controllers\BaseController;

class Permohonan extends BaseController
{
    private $page = 'Permohonan';
    private $url = 'permohonan';
    private $path = 'Master/permohonan';
    protected $model;
    protected $model_izin;
    protected $model_persyaratan_permohonan;
    protected $model_kendali_alur;
    protected $request;
    protected $primaryKey = 'tblizinpermohonan_id';
    public function __construct()
    {
        $this->request = Services::request();

        $this->model =  new M_permohonan($this->request);
    }

    public function index()
    {
        $this->model_izin =  new \App\Models\Master\M_izin($this->request);
        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['izin'] = $this->model_izin->get_data();


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

            $jml = $this->get_persyaratan_by_id_permohonan($l[$this->primaryKey])->countAllResults();
            $html = '<a href="#" onclick="lihat_persyaratan(\'' . $l[$this->primaryKey] . '\')"> Lihat (' . $jml . ')</a>';

            $row[] =  $jml ? $html : '';

            $jml =  $this->get_kendali_alur_by_id_permohonan($l[$this->primaryKey])->countAllResults();
            $html = '<a href="#" onclick="lihat_kendali_alur(\'' . $l[$this->primaryKey] . '\')">Lihat (' . $jml . ')</a>';
            $row[] =  $jml ? $html : '';


            $row[] =  '<div class="text-wrap">' .  $l['tblizin_nama'] . '</div>';
            $row[] =  '<div class="text-wrap">' .  $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = $l['tblizinpermohonan_register'];
            $row[] = status_aktif($l['tblizinpermohonan_isaktif']);
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
            'tblizinpermohonan_nama' => 'required',
            'tblizinpermohonan_register' => 'required',
            'tblizinpermohonan_isaktif' => 'required',

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
                $d['tblizinpermohonan_isaktif'] = 'T';
                $this->model->update($r, $d);
            } else if ($opsi == 2) {
                $d['tblizinpermohonan_isaktif'] = 'F';
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


    public function get_persyaratan()
    {

        $id = $this->request->getPost('id');
        $data['rows'] = $this->get_persyaratan_by_id_permohonan($id)->get()->getResultArray();
        // echo json_encode($data['rows']);
        return view($this->path . '/tabel_persyaratan', $data);
    }

    public function get_persyaratan_by_id_permohonan($id)
    {
        $this->model_persyaratan_permohonan = new \App\Models\Master\M_persyaratan_permohonan($this->request);
        return  $this->model_persyaratan_permohonan->get_persyaratan_by_id_permohonan($id);
    }


    public function get_kendali_alur_by_id_permohonan($id)
    {
        $this->model_kendali_alur = new \App\Models\Master\M_kendali_alur($this->request);
        return $this->model_kendali_alur->get_kendali_alur_by_id_permohonan($id);
    }


    public function get_kendali_alur()
    {

        $id = $this->request->getPost('id');
        $data['rows'] = $this->get_kendali_alur_by_id_permohonan($id)->get()->getResultArray();
        // echo json_encode($data['rows']);
        return view($this->path . '/tabel_kendali_alur', $data);
    }
}