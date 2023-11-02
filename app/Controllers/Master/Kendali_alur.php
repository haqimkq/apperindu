<?php


namespace App\Controllers\Master;

use Config\Services;
use App\Models\Master\M_kendali_alur;
use App\Controllers\BaseController;


class Kendali_alur extends BaseController
{
    private $page = 'Kendali Alur';
    private $url = 'kendali_alur';
    private $path = 'Master/kendali_alur';

    protected $model;
    protected $model_izin;
    protected $model_permohonan;
    protected $request;
    protected $primaryKey = 'tblkendalialur_id';

    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_kendali_alur($this->request);
        $this->model_permohonan =  new \App\Models\Master\M_permohonan($this->request);
    }


    public function index()
    {


        $this->model_izin =  new \App\Models\Master\M_izin($this->request);
        $this->model_blok_sistem =  new \App\Models\Master\M_blok_sistem($this->request);

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['izin'] = $this->model_izin->findAll();
        $data['permohonan'] = $this->model_permohonan->findAll();
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
            // $row[] = $l['tblkecamatan_id'];
            $row[] = $l['tblizin_nama'];
            $row[] = $l['tblizinpermohonan_nama'];
            $row[] = $l['tblkendalibloksistem_nama'];
            $row[] = $l['tblkendalialur_urut'];
            $row[] = status_aktif($l['tblkendalialur_isaktif']);
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
            'tblkendalibloksistem_id' => 'required',
            'tblkendalialur_urut' => 'required',
            'tblkendalialur_isaktif' => 'required',
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
                $d['tblkendalialur_isaktif'] = 'T';
                $this->model->update($r, $d);
            } else if ($opsi == 2) {
                $d['tblkendalialur_isaktif'] = 'F';
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
}