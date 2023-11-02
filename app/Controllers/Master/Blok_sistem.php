<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Models\Master\M_blok_sistem;
use App\Controllers\BaseController;


class Blok_sistem extends BaseController
{
    private $page = 'Blok Sistem';
    private $url = 'blok_sistem';
    private $path = 'Master/blok_sistem';

    protected $model;
    protected $model_blok_sistem_tugas;
    protected $model_pengguna;
    protected $request;
    protected $primaryKey = 'tblkendalibloksistem_id';

    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_blok_sistem($this->request);
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
            </div>';


            $jml = $this->get_by_id_blok_sistem($l[$this->primaryKey])->countAllResults();
            $html = '<a href="#" onclick="lihat_blok_sistem_tugas(\'' . $l[$this->primaryKey] . '\')"> Lihat (' . $jml . ')</a>';

            $row[] = $jml ? $html : '';


            $jml = $this->get_by_id_pengguna($l[$this->primaryKey])->countAllResults();
            $html = '<a href="#" onclick="lihat_pengguna(\'' . $l[$this->primaryKey] . '\')"> Lihat (' . $jml . ')</a>';

            $row[] = $jml ? $html : '';
            $row[] = $l['tblkendalibloksistem_nama'];
            $row[] = status_aktif($l['tblkendalibloksistem_isaktif']);
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
            'tblkendalibloksistem_nama' => 'required',
            'tblkendalibloksistem_isaktif' => 'required',
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
                $d['tblkendalibloksistem_isaktif'] = 'T';
                $this->model->update($r, $d);
            } else if ($opsi == 2) {
                $d['tblkendalibloksistem_isaktif'] = 'F';
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

    public function get_by_id_blok_sistem($id)
    {
        $this->model_blok_sistem_tugas = new \App\Models\Master\M_blok_sistem_tugas($this->request);
        return $this->model_blok_sistem_tugas->get_by_id_blok_sistem($id);
    }

    public function get_blok_sistem()
    {

        $id = $this->request->getPost('id');
        $data['rows'] = $this->get_by_id_blok_sistem($id)->get()->getResultArray();

        return view($this->path . '/tabel_blok_sistem_tugas', $data);
    }


    public function get_pengguna()
    {

        $id = $this->request->getPost('id');
        $data['rows'] = $this->get_by_id_pengguna($id)->get()->getResultArray();

        return view($this->path . '/tabel_pengguna', $data);
    }

    public function get_by_id_pengguna($id)
    {
        $this->model_pengguna =  new \App\Models\Master\M_pengguna($this->request);
        return $this->model_pengguna->get_by_id_blok_sistem($id);
    }
}