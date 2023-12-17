<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Models\Master\M_pengguna;
use App\Models\Master\M_blok_sistem;
use App\Controllers\BaseController;

class Pengguna extends BaseController
{

    private $page = 'Pengguna';
    private $url = 'pengguna';
    private $path = 'Master/pengguna';

    protected $model;
    protected $model_blok_sistem;
    protected $request;
    protected $primaryKey = 'tblpengguna_id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_pengguna($this->request);
        $this->model_blok_sistem =  new M_blok_sistem($this->request);
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
            $row[] = '<input type="checkbox" name="id[]" value="' . $l[$this->primaryKey] . '" class="bulk">';
            $row[] = '  <div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">
               
             
                <li><a class="dropdown-item" href="' . site_url($this->url . '/form_page/' . $l[$this->primaryKey]) . '">Edit</a>
                </li>
                <li><a class="dropdown-item" href="#" onclick="edit_password(\'' . $l[$this->primaryKey] . '\')">Edit password</a>
                </li>
                <li><a class="dropdown-item" href="#" onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</a>
                </li>
            </ul>
        </div>';
            // $row[] = '
            //     <div class="btn-group">
            //     <button type="button"
            //         class="btn  btn-sm btn-outline-primary"  onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</button>
            //         <a class="btn btn-sm btn-outline-primary" href="' . site_url($this->url . '/form_page/' . $l[$this->primaryKey]) . '">Edit</a>

            // </div>';
            // $row[] = $l['tblkecamatan_id'];
            $row[] = $l['username'];
            $row[] = '<div class="text-wrap">' . $l['tblpengguna_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblpengguna_unitkerja'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblkendalibloksistem_nama'] . '</div>';

            $row[] =  status_aktif($l['tblpengguna_isaktif']);
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
            'tblpengguna_nama' => 'required',
            'tblkendalibloksistem_id' => 'required',
            'tblpengguna_isaktif' => 'required',
            'username' => 'required|is_unique[tblpengguna_new.username]',
            'tblpengguna_password' => 'required|min_length[6]',
        ];



        foreach ($this->model->allowedfields() as $r) {
            $d[$r] = $this->request->getPost($r);
            if ($r == 'blpengguna_id') {
                break;
            }
        }

        unset($d['tblpengguna_password']);
        $pw = $this->request->getVar('tblpengguna_password');
        $d['tblpengguna_password'] =  password_hash($pw, PASSWORD_DEFAULT);

        if ($this->validate($rules)) {


            $i =  $this->model->save($d);

            if ($i) {

                $response = array('status' => true, 'msg' => success_add());
                echo json_encode($response);
            } else {

                $response = array('status' => false, 'msg' => failed());
                echo json_encode($response);
            }
        } else {

            $response = array('status' => false, 'msg' => failed());
            echo json_encode($response);
        }


        // return redirect()->to('/' . $this->url);
    }

    public function form_update()
    {

        $rules = [
            'tblpengguna_nama' => 'required',
            'tblkendalibloksistem_id' => 'required',
            'username' => 'required',
        ];



        foreach ($this->model->allowedfields() as $r) {
            $d[$r] = $this->request->getPost($r);
        }

        $id = $this->request->getPost('id');
        unset($d['tblpengguna_password'], $d['tblpengguna_nip'], $d['tblpengguna_jabatan']);

        if ($this->validate($rules)) {
            if ($id) {

                $u =  $this->model->update($id, $d);

                if ($u) {
                    $response = array('status' => true, 'msg' => success_update());
                    echo json_encode($response);
                } else {
                    $response = array('status' => false, 'msg' => failed());
                    echo json_encode($response);
                }
            }
        } else {

            $response = array('status' => false, 'msg' => failed());
            echo json_encode($response);
        }
    }

    public function form_update_password()
    {

        $rules = [
            'tblpengguna_password' => 'required|min_length[6]',
        ];

        $id = $this->request->getPost('id');
        $pw = $this->request->getVar('tblpengguna_password');
        $d['tblpengguna_password'] =  password_hash($pw, PASSWORD_DEFAULT);

        if ($this->validate($rules)) {
            if ($id) {

                $u =  $this->model->update($id, $d);

                if ($u) {
                    $response = array('status' => true, 'msg' => success_update());
                    echo json_encode($response);
                } else {
                    $response = array('status' => false, 'msg' => failed());
                    echo json_encode($response);
                }
            }
        } else {

            $response = array('status' => false, 'msg' => failed());
            echo json_encode($response);
        }
    }


    public function form_bulk()
    {


        $opsi = $this->request->getPost('bulk_opsi');

        $id = $this->request->getPost('id');


        foreach ($id as $r) {

            if ($opsi == 1) {
                $d['tblpengguna_isaktif'] = 'T';
                $this->model->update($r, $d);
            } else if ($opsi == 2) {
                $d['tblpengguna_isaktif'] = 'F';
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


    public function username_check()
    {
        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $row = $this->model->username_check($id, $username);

        if (!$row) {
            $response = array('status' => true);
            echo json_encode($response);
        } else {
            $response = array('status' => false);
            echo json_encode($response);
        }
    }

    public function form_page($id = null)
    {

        $data['title'] = 'Form ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['blok_sistem'] = $this->model_blok_sistem->findAll();
        $data['request'] = $this->request;


        if ($id) {
            return view($this->path . '/form_update_page', $data);
        }

        return view($this->path . '/form_page', $data);
    }

    public function logout()
    {

        session()->destroy();
        return redirect()->to('/login');
    }
}
