<?php

namespace App\Controllers;

use App\Models\Api\MJwt;
use Config\Services;
use App\Models\M_pendaftaran;
use App\Models\M_izinpersyaratanlengkap;
use App\Models\M_kendali_proses;
use App\Models\M_pemohon;
use App\Models\M_persyaratan_pemohon;
use App\Models\M_retribusi;
use App\Models\Master\M_izin;
use App\Models\Master\M_permohonan;
use App\Models\Master\M_persyaratan_permohonan;
use Dompdf\Dompdf;

class Pendaftaran extends BaseController
{

    private $page = 'Pendaftaran';
    private $url = 'pendaftaran';
    private $path = 'pendaftaran';

    protected $model;
    protected $model_izin;
    protected $model_pemohon;
    protected $model_permohonan;
    protected $model_kecamatan;
    protected $model_kelurahan;
    protected $model_retribusi;

    protected $model_persyartaan_lengkap;
    protected $model_kendali_proses;
    protected $model_persyaratan_pemohon;
    protected $model_persyaratan;
    protected $model_jwt;
    protected $request;
    protected $dompdf;
    protected $primaryKey = 'tblizinpendaftaran_id';


    public function __construct()
    {
        $this->request = Services::request();
        $this->model =  new M_pendaftaran($this->request);
        $this->model_kendali_proses = new M_kendali_proses($this->request);
        $this->dompdf = new Dompdf(array('enable_remote' => true));
        $this->model_persyaratan_pemohon = new M_persyaratan_pemohon($this->request);
        $this->model_izin =  new M_izin($this->request);
        $this->model_permohonan =  new M_permohonan($this->request);
        $this->model_pemohon =  new M_pemohon($this->request);
        $this->model_persyaratan = new M_persyaratan_permohonan($this->request);
        $this->model_jwt =  new MJwt();
    }


    public function index()

    {


        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['izin'] = $this->model_izin->get_data();
        $data['permohonan'] = $this->model_permohonan->get_data();

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

            $opsi = '<div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">
             
                
                <li><a class="dropdown-item" target="_blank" href="' . site_url($this->url . '/cetak_tanda_terima/' . $l[$this->primaryKey]) . '">Cetak tanda terima</a>
                </li>
                <li><a class="dropdown-item" target="_blank" href="' . site_url($this->url . '/cetak_kartu_kendali/' . $l[$this->primaryKey]) . '">Cetak kartu kendali</a>
                </li>
                <li><a class="dropdown-item"  href="#" onclick="log(\'' . $l[$this->primaryKey] . '\')">Log Berkas</a>
                </li>
                <li><a class="dropdown-item" href="' . site_url('pendaftaran/update/' . $l[$this->primaryKey]) . '">Edit</a>
                </li>
                <li><a class="dropdown-item" href="#" onclick="hapus(\'' . $l[$this->primaryKey] . '\')">Hapus</a>
                </li>
            </ul>
            </div>';

            $row[] = $opsi;
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_nomor'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_namapemohon'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_usaha'] . '</div>';
            $row[] = pendaftaran($l['tblizinpendaftaran_idonline']);
            $row[] = status_pendaftaran($l['tblizinpendaftaran_issign']);
            $row[] = '<div class="text-wrap">' . tanggal($l['tblizinpendaftaran_tgljam']) . '</div>';




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

    public function form_page($id)
    {


        $this->model_kecamatan =  new \App\Models\Master\M_kecamatan($this->request);
        $data['title'] = 'Form ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['id_pemohon'] = $id;
        $data['izin'] = $this->model_izin->get_data();
        $data['kecamatan'] = $this->model_kecamatan->findAll();


        return view($this->path . '/form_page', $data);
    }

    public function update($id)
    {

        $this->model_kecamatan =  new \App\Models\Master\M_kecamatan($this->request);
        $data['title'] = 'Form ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['id'] = $id;
        $data['izin'] = $this->model_izin->get_data();
        $data['kecamatan'] = $this->model_kecamatan->findAll();


        return view($this->path . '/form_update', $data);
    }


    public function update_primary()
    {
        $id = $this->request->getPost('id');
        $url = $this->request->getPost('url');
        $arr = ['tblizinpendaftaran_namapemohon', 'tblizinpendaftaran_almtpemohon', 'tblizinpendaftaran_usaha', 'tblizinpendaftaran_lokasiizin'];
        foreach ($arr as $r) {

            $d[$r] = $this->request->getPost($r);
        }

        $d['tblpengguna_id'] = session()->id;
        // proses edit pendaftaran
        $up =  $this->model->update($id, $d);


        if ($up) {
            session()->setFlashdata('success', success_update());
        } else {
            session()->setFlashdata('error', failed());
        }

        return redirect()->to('/' . $url);
    }

    public function form_update()
    {

        $id_pendaftaran = $this->request->getPost('tblizinpendaftaran_id');
        $row =  $this->model_kendali_proses->count_by_id_pendaftaran($id_pendaftaran);

        // proses berkas lebih dari 2 tidak bisa diedit
        if ($row > 2) {
            $res = array('status' => false, 'msg' => 'Tidak bisa diedit karena berkas sudah masuk');
            return $this->response->setJSON($res);
        }

        $this->model_persyartaan_lengkap  = new M_izinpersyaratanlengkap();
        $this->model_retribusi = new M_retribusi();

        // validasi form
        $rules = [
            'tblizin_id' => 'required',
            'tblizinpermohonan_id' => 'required',
            'tblizinpendaftaran_namapemohon' => 'required',
            'tblizinpendaftaran_usaha' => 'required',
            'tblizinpendaftaran_idpemohon' => 'required',
            'tblizinpendaftaran_npwp' => 'required',
            'tblizinpendaftaran_almtpemohon' => 'required',
            'tblizinpendaftaran_telponpemohon' => 'required',
            'tblizinpendaftaran_lokasiizin' => 'required',
            'tblkecamatan_id' => 'required',
            'tblkelurahan_id' => 'required',
            'tblizinpendaftaran_keterangan' => 'required',
        ];

        // jika tidak valid
        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        // array untuk edit pendaftaran
        foreach ($this->model->allowedfields() as $r) {

            $d[$r] = $this->request->getPost($r);
            if ($r == 'tblizinpendaftaran_keterangan') {
                break;
            }
        }

        $d['tblpengguna_id'] = session()->id;
        // proses edit pendaftaran
        $up =  $this->model->update($id_pendaftaran, $d);

        if (!$up) {

            $res = array('status' => true, 'msg' =>  failed());
            return $this->response->setJSON($res);
        }

        $id_permohonan = $this->request->getPost('tblizinpermohonan_id');
        //  mengambil persyaratan by id_permohonan untuk upload persyaratan

        $p = $this->get_persyaratan($id_permohonan);

        // ekstensi file diterima 
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'pdf');
        $validFiles = [];
        foreach ($p as $row) {

            // cek ekstensi 
            $file = $this->request->getFile($row['tblpersyaratan_id']);
            $fileExtension = $file->guessExtension();

            // persyaratan yang kosong dilewati saja
            if (!$file->getError() == 4) {
                if (in_array($fileExtension, $allowedExtensions)) {
                    // File ekstensi valid, bisa diunggah, (ditampung dlu )
                    $validFiles[$row['tblpersyaratan_id']] = $file;
                } else {

                    //  jika tidak valid = stop proses nya
                    $res = array('status' => false, 'msg' => 'Harap upload file ' . $row['tblpersyaratan_nama'] . ' dengan format ' . implode(',', $allowedExtensions));
                    return $this->response->setJSON($res);
                }
            }
        }

        // update persyaratan
        foreach ($validFiles as $key => $file) {
            //  pindah ke direktori
            $file->move('doc/persyaratan');

            // edit persyaratan pendaftaran
            $pp['tblpemohon_id'] = $d['tblpemohon_id'];
            $pp['tblpersyaratan_id'] = $key;

            // cek dlu, jika sudah ada maka edit, jika tidak maka insert
            $r = $this->model_persyaratan_pemohon->get_persyaratan_pemohon($pp);

            if ($r) {
                $du['tblizinpendaftaran_id'] = $id_pendaftaran;
                $du['tblpemohonpersyaratan_file'] = $file->getName();
                if (!$this->model_persyaratan_pemohon->update($r['tblpemohonpersyaratan_id'], $du)) {



                    $res = array('status' => false, 'msg' =>  failed());
                    return $this->response->setJSON($res);
                }

                if (file_exists('doc/persyaratan/' . $r['tblpemohonpersyaratan_file'])) {
                    unlink('doc/persyaratan/' . $r['tblpemohonpersyaratan_file']);
                }
            } else {
                $pp['tblizinpendaftaran_id'] = $id_pendaftaran;
                $pp['tblpemohonpersyaratan_file'] = $file->getName();
                if (!$this->model_persyaratan_pemohon->insert($pp)) {
                    $res = array('status' => false, 'msg' =>  failed());
                    return $this->response->setJSON($res);
                }
            }
        }


        $res = array('status' => true, 'msg' =>  success_update());
        return $this->response->setJSON($res);
    }

    public function form()
    {

        $this->model_persyartaan_lengkap  = new M_izinpersyaratanlengkap();
        $this->model_retribusi = new M_retribusi();

        // validasi form
        $rules = [
            'tblizin_id' => 'required',
            'tblizinpermohonan_id' => 'required',
            'tblizinpendaftaran_namapemohon' => 'required',
            'tblizinpendaftaran_usaha' => 'required',
            'tblizinpendaftaran_idpemohon' => 'required',
            'tblizinpendaftaran_npwp' => 'required',
            'tblizinpendaftaran_almtpemohon' => 'required',
            'tblizinpendaftaran_telponpemohon' => 'required',
            'tblizinpendaftaran_lokasiizin' => 'required',
            'tblkecamatan_id' => 'required',
            'tblkelurahan_id' => 'required',

        ];

        // jika tidak valid
        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => 'Form tidak lengkap');
            return $this->response->setJSON($res);
        }

        $id_permohonan = $this->request->getVar('tblizinpermohonan_id');

        //  mengambil persyaratan by id_permohonan
        $p = $this->get_persyaratan($id_permohonan);

        // ekstensi file diterima 
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'pdf');
        $validFiles = [];
        foreach ($p as $row) {

            $file = $this->request->getFile($row['tblpersyaratan_id']);

            // persyaratan yang kosong dilewati saja
            if ($file) {
                if (!$file->getError() == 4) {

                    // cek ekstensi 
                    $fileExtension = $file->guessExtension();
                    if (in_array($fileExtension, $allowedExtensions)) {
                        // File ekstensi valid, bisa diunggah
                        $validFiles[$row['tblpersyaratan_id']] = $file;
                    } else {

                        //  jika tidak valid = stop proses nya
                        $res = array('status' => false, 'msg' => 'Harap upload file ' . $row['tblpersyaratan_nama'] . ' dengan format ' . implode(',', $allowedExtensions));
                        return $this->response->setJSON($res);
                    }
                }
            }
        }


        // array untuk input pendaftaran
        foreach ($this->model->allowedfields() as $r) {

            $d[$r] = $this->request->getVar($r);
            if ($r == 'tblizinpendaftaran_keterangan') {
                break;
            }
        }

        $id_izin = $this->request->getVar('tblizin_id');

        $time = date('Y-m-d H:i:s');
        $n  = $this->model->get_nomor_registrasi() . '/' . $this->model->get_nomor_registrasi_by_id_izin($id_izin) . '/' . $id_izin . '/' . date('m') . '/' . date('Y');
        $d['tblizinpendaftaran_nomor'] = $n;
        $d['tblizinpendaftaran_tgljam'] =  $time;
        $d['tblizinpendaftaran_tglbataslambat'] = $time;
        $d['tblizinpendaftaran_multi'] = 'F';
        $d['tblpengguna_id'] = session()->id;

        if ($this->request->getVar('tblpengguna_id')) {
            $d['tblpengguna_id'] = $this->request->getVar('tblpengguna_id');
        }

        if ($this->request->getVar('status_online')) {
            $d['status_online'] = $this->request->getVar('status_online');
            $d['tblizinpendaftaran_idonline'] = $this->id_online();
        }

        // insert pendaftaran
        $i =  $this->model->save($d);
        $id = $this->model->getInsertID();

        // update persyaratan
        foreach ($validFiles as $key => $file) {
            //  pindah ke direktori
            $file->move('doc/persyaratan');

            // edit persyaratan pendaftaran
            $pp['tblpemohon_id'] = $d['tblpemohon_id'];
            $pp['tblpersyaratan_id'] = $key;

            // cek dlu, jika sudah ada maka edit, jika tidak maka insert
            $r = $this->model_persyaratan_pemohon->get_persyaratan_pemohon($pp);

            if ($r) {
                $du['tblizinpendaftaran_id'] = $id;
                $du['tblpemohonpersyaratan_file'] = $file->getName();

                if (!$this->model_persyaratan_pemohon->update($r['tblpemohonpersyaratan_id'], $du)) {
                    $res = array('status' => false, 'msg' =>  failed());
                    return $this->response->setJSON($res);
                }

                if (file_exists('doc/persyaratan/' . $r['tblpemohonpersyaratan_file'])) {
                    unlink('doc/persyaratan/' . $r['tblpemohonpersyaratan_file']);
                }
            } else {
                $pp['tblizinpendaftaran_id'] = $id;
                $pp['tblpemohonpersyaratan_file'] = $file->getName();
                if (!$this->model_persyaratan_pemohon->insert($pp)) {
                    $res = array('status' => false, 'msg' =>  failed());
                    return $this->response->setJSON($res);
                }
            }
        }

        // insert persyartan lengkap
        foreach ($p  as $r) {
            $d2['tblizinpersyaratan_id'] = $r['tblizinpersyaratan_id'];
            $d2['tblizinpendaftaran_id'] = $id;

            $this->model_persyartaan_lengkap->save($d2);
        }

        // insert kendali alur progres
        $d3['tblizinpendaftaran_id'] = $id;
        // 9 adalah input pendaftaran berkas
        $d3['tblkendalibloksistemtugas_id'] = 9;
        $d3['tblkendaliproses_tglmulai'] = $time;
        $d3['tblkendaliproses_tglmulai_sys'] = $time;
        $d3['tblkendaliproses_tglselesai'] = $time;
        $d3['tblkendaliproses_tglselesai_sys'] = $time;
        // 12 adalah pemohon
        $d3['tblkendalibloksistem_idasal'] = 12;
        // 1 adalah staf pendaftaran

        $id_kirim = 1;
        if (session()->blok_sistem_id) {
            $id_kirim = session()->blok_sistem_id;
        }

        $d3['tblkendalibloksistem_idkirim'] = $id_kirim;

        $d3['tblkendaliproses_catatan'] = 'Pendaftaran';
        $d3['tblkendaliproses_isparaf'] = 'T';
        $d3['tblkendaliproses_isberkasfisikdikirim'] = 'T';
        $d3['tblkendaliproses_tglberkasfisikdikirim'] = $time;
        $d3['tblkendaliproses_tglberkasfisikdikirim_sys'] = $time;
        $d3['tblkendaliproses_tglterima'] = $time;
        // 4 belum tahu ? apa itu 4 ihh ai lah
        $d3['tblkendaliproses_status'] = 4;

        $d3['tblpengguna_id'] = session()->id;
        if ($this->request->getVar('tblpengguna_id')) {
            $d3['tblpengguna_id'] = $this->request->getVar('tblpengguna_id');
        }

        $this->model_kendali_proses->save($d3);

        // input retibusi
        $time = date('Y-m-d');
        $d4['tblizinpendaftaran_id'] = $id;
        if (!in_array($id_izin, get_izin_type_1())) {
            $d4['tblretribusikeringanan_id'] = 0;
            $d4['tblretribusi_total'] = 0;
            $d4['tblretribusi_keringanan'] = 0;
            $d4['tblretribusi_nilai'] = 0;
            $d4['tblretribusi_tgljadi'] = $time;
            $d4['tblretribusi_tglbayar'] = $time;
            $d4['tblretribusi_nomorskrd'] = '-';
            $d4['tblretribusi_nobuktibayar'] = '-';
        }

        $this->model_retribusi->save($d4);

        if (!$i) {

            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        $id = $this->model_kendali_proses->getInsertID();

        $res = array('status' => true, 'msg' =>  success_add() . ', lanjut melakukan kendali berkas', 'url' => site_url('kendali_berkas/form_page/' . $id));
        return $this->response->setJSON($res);
    }

    public function form_update_api()
    {

        $id_pendaftaran = $this->request->getPost('tblizinpendaftaran_id');

        // validasi form
        $rules = [
            'tblizin_id' => 'required',
            'tblizinpermohonan_id' => 'required',
            'tblizinpendaftaran_namapemohon' => 'required',
            'tblizinpendaftaran_usaha' => 'required',
            'tblizinpendaftaran_idpemohon' => 'required',
            'tblizinpendaftaran_npwp' => 'required',
            'tblizinpendaftaran_almtpemohon' => 'required',
            'tblizinpendaftaran_telponpemohon' => 'required',
            'tblizinpendaftaran_lokasiizin' => 'required',
            'tblkecamatan_id' => 'required',
            'tblkelurahan_id' => 'required',

        ];

        // jika tidak valid
        if (!$this->validate($rules)) {

            $res = array('status' => false, 'msg' => failed());
            return $this->response->setJSON($res);
        }

        // array untuk edit pendaftaran
        foreach ($this->model->allowedfields() as $r) {

            $d[$r] = $this->request->getPost($r);
            if ($r == 'tblizinpendaftaran_keterangan') {
                break;
            }
        }
        $d['status_online'] = $this->request->getVar('status_online');

        // proses edit pendaftaran
        $up =  $this->model->update($id_pendaftaran, $d);

        if (!$up) {

            $res = array('status' => true, 'msg' =>  failed());
            return $this->response->setJSON($res);
        }

        $id_permohonan = $this->request->getPost('tblizinpermohonan_id');
        //  mengambil persyaratan by id_permohonan
        $p = $this->get_persyaratan($id_permohonan);
        // ekstensi file diterima 
        $allowedExtensions = array('jpg', 'png', 'pdf');
        $validFiles = [];
        foreach ($p as $row) {

            $file = $this->request->getFile($row['tblpersyaratan_id']);

            // persyaratan yang kosong dilewati saja
            if ($file) {
                if (!$file->getError() == 4) {
                    // cek ekstensi 
                    $fileExtension = $file->guessExtension();
                    if (in_array($fileExtension, $allowedExtensions)) {
                        // File ekstensi valid, bisa diunggah
                        $validFiles[$row['tblpersyaratan_id']] = $file;
                    } else {

                        //  jika tidak valid = stop proses nya
                        $res = array('status' => false, 'msg' => 'Harap upload file ' . $row['tblpersyaratan_nama'] . ' dengan format ' . implode(',', $allowedExtensions));
                        return $this->response->setJSON($res);
                    }
                }
            }
        }

        foreach ($validFiles as $key => $file) {
            //  pindah ke direktori
            $file->move('doc/persyaratan');

            // edit persyaratan pendaftaran
            $pp['tblpemohon_id'] = $d['tblpemohon_id'];
            $pp['tblpersyaratan_id'] = $key;

            // cek dlu, jika sudah ada maka edit, jika tidak maka insert
            $r = $this->model_persyaratan_pemohon->get_persyaratan_pemohon($pp);

            if ($r) {
                $du['tblizinpendaftaran_id'] = $id_pendaftaran;
                $du['tblpemohonpersyaratan_file'] = $file->getName();
                if (!$this->model_persyaratan_pemohon->update($r['tblpemohonpersyaratan_id'], $du)) {
                    $res = array('status' => false, 'msg' =>  failed());
                    return $this->response->setJSON($res);
                }

                if (file_exists('doc/persyaratan/' . $r['tblpemohonpersyaratan_file'])) {
                    unlink('doc/persyaratan/' . $r['tblpemohonpersyaratan_file']);
                }
            } else {
                $pp['tblizinpendaftaran_id'] = $id_pendaftaran;
                $pp['tblpemohonpersyaratan_file'] = $file->getName();
                if (!$this->model_persyaratan_pemohon->insert($pp)) {
                    $res = array('status' => false, 'msg' =>  failed());
                    return $this->response->setJSON($res);
                }
            }
        }

        $time = date('Y-m-d H:i:s');
        // insert kendali alur progres
        $d3['tblizinpendaftaran_id'] = $id_pendaftaran;
        // 9 adalah input pendaftaran berkas
        $d3['tblkendalibloksistemtugas_id'] = 9;
        $d3['tblkendaliproses_tglmulai'] = $time;
        $d3['tblkendaliproses_tglmulai_sys'] = $time;
        $d3['tblkendaliproses_tglselesai'] = $time;
        $d3['tblkendaliproses_tglselesai_sys'] = $time;
        // 12 adalah pemohon
        $d3['tblkendalibloksistem_idasal'] = 12;
        // 1 adalah staf pendaftaran

        $id_kirim = 1;
        if (session()->blok_sistem_id) {
            $id_kirim = session()->blok_sistem_id;
        }

        $d3['tblkendalibloksistem_idkirim'] = $id_kirim;

        $d3['tblkendaliproses_catatan'] = 'Pendaftaran';
        $d3['tblkendaliproses_isparaf'] = 'T';
        $d3['tblkendaliproses_isberkasfisikdikirim'] = 'T';
        $d3['tblkendaliproses_tglberkasfisikdikirim'] = $time;
        $d3['tblkendaliproses_tglberkasfisikdikirim_sys'] = $time;
        $d3['tblkendaliproses_tglterima'] = $time;
        // 4 belum tahu ? apa itu 4 ihh ai lah
        $d3['tblkendaliproses_status'] = 4;

        $d3['tblpengguna_id'] = session()->id;
        if ($this->request->getVar('tblpengguna_id')) {
            $d3['tblpengguna_id'] = $this->request->getVar('tblpengguna_id');
        }

        $this->model_kendali_proses->save($d3);

        $res = array('status' => true, 'msg' =>  success_update());
        return $this->response->setJSON($res);
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

    public function get_pemohon()
    {


        $id = $this->request->getPost('id');
        $row = $this->model_pemohon->find($id);

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


        $id = $this->request->getPost('id_izin');
        $rows = $this->model_permohonan->get_permohonan_by_id_izin($id)->get()->getResultArray();


        if ($rows) {
            $response = array('status' => true, 'data' => $rows);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'msg' =>  'Data tidak ditemukan');
            echo json_encode($response);
        }
    }


    public function get_kelurahan_by_id_kecamatan_json()
    {
        $this->model_kelurahan =  new \App\Models\Master\M_kelurahan($this->request);

        $id = $this->request->getPost('id_kecamatan');
        $rows = $this->model_kelurahan->get_by_id_kecamatan($id)->get()->getResultArray();

        if ($rows) {
            $response = array('status' => true, 'data' => $rows);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'msg' =>  'Data tidak ditemukan');
            echo json_encode($response);
        }
    }


    public function get_persyaratan_form()
    {


        $id = $this->request->getPost('id');
        $id_pemohon = $this->request->getPost('id_pemohon');

        $rows =   $this->model_persyaratan->get_persyaratan_by_id_permohonan($id)->get()->getResultArray();
        $arr = array();
        foreach ($rows as $r) {

            $r['file'] = $this->get_persyaratan_pemohon($id_pemohon, $r['tblpersyaratan_id']);
            $arr[] = $r;
        }


        return view($this->path . '/persyaratan_form', array('row' => $arr));
    }


    public function get_persyaratan_pemohon($id_pemohon, $id_persyaratan)
    {

        $row = $this->model_persyaratan_pemohon->get_by_id_pemohon_and_persyaratan($id_pemohon, $id_persyaratan);

        if ($row) {
            return $row['tblpemohonpersyaratan_file'];
        }

        return null;
    }

    public function get_persyaratan($id)
    {


        return $this->model_persyaratan->get_persyaratan_by_id_permohonan($id)->get()->getResultArray();
    }

    public function cetak_tanda_terima($id)
    {



        $r = $this->model->get_by_id($id);
        $data['title'] = 'Tanda Terima';
        $data['r'] = $r;

        $page = view($this->path . '/cetak_tanda_terima', $data);

        $this->dompdf->loadHtml($page);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream('Tanda Terima.pdf', array("Attachment" => false));
    }


    public function cetak_kartu_kendali($id)
    {


        $data['r'] = $this->model->get_by_id($id);
        $data['p'] = $this->get_persyaratan_pendaftaran($id);
        $data['title'] = 'Kartu Kendali';
        $page = view($this->path . '/cetak_kartu_kendali', $data);
        $this->dompdf->loadHtml($page);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream('Kartu Kendali.pdf', array("Attachment" => false));
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

    // untuk cetak, pada view terdapatjoin ke tabel tblizinlengkapisyarat
    private function get_persyaratan_pendaftaran($id)
    {
        $db      = \Config\Database::connect();
        $m = $db->table('v_persyaratan');
        $m->where('tblizinpendaftaran_id', $id);
        return $m->get()->getResultArray();
    }

    public function log()
    {

        $id = $this->request->getPost('id');
        $d['r']  = $this->model->get_by_id($id);
        $d['kp'] = $this->model_kendali_proses->get_by_id_pendaftaran($id);

        return view($this->path . '/log', $d);
    }

    // info persyaratan yang dimiliki berdasarkan pendaftaran (tampil di modal)
    public function persyaratan()
    {


        $id = $this->request->getPost('id');
        $r = $this->model->get_by_id($id);
        // cari persyaratan by pemohon
        $p = $this->model_persyaratan_pemohon->get_by_id_pemohon($r['tblpemohon_id']);

        $data['title'] = 'Data Persyaratan';
        $data['page'] = 'Persyaratan';
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['p'] = $p;
        $data['id'] = $id;

        return view($this->path . '/persyaratan', $data);
    }




    private function id_online()
    {
        $this->model->selectMax('tblizinpendaftaran_idonline');
        $row = $this->model->first();

        return $row['tblizinpendaftaran_idonline'];
    }
}
