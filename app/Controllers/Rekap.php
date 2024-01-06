<?php

namespace App\Controllers;

use App\Models\M_kendali_proses;
use App\Models\M_pendaftaran;
use App\Models\M_rekap;
use App\Models\Master\M_izin;
use App\Models\Master\M_kecamatan;
use App\Models\Master\M_permohonan;
use App\Models\Master\M_template;
use App\Models\Master\M_variabel_sk;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rekap extends BaseController
{

    private $page = 'Rekap Surat Keterangan';
    private $url = 'rekap';
    private $path = 'rekap';

    protected $model;
    protected $model_pendaftaran;
    protected $model_blok_sistem;
    protected $model_kendali_alur;
    protected $model_izin;
    protected $model_permohonan;
    protected $model_kecamatan;

    protected $model_template;
    protected $model_variabel;
    protected $primaryKey       = 'tblkendaliproses_id';
    protected $model_blok_sistem_tugas;
    protected $request;

    public function __construct()
    {
        $this->request = Services::request();
        $this->model = new M_rekap($this->request);
        $this->model_izin = new M_izin($this->request);
        $this->model_permohonan = new M_permohonan($this->request);
        $this->model_kecamatan = new M_kecamatan($this->request);
        $this->model_pendaftaran = new M_pendaftaran($this->request);
        $this->model_template = new M_template($this->request);
        $this->model_variabel = new M_variabel_sk($this->request);
    }


    public function index()
    {


        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['izin'] = $this->model_izin->get_data();
        $data['kecamatan'] = $this->model_kecamatan->findAll();
        $data['permohonan'] = $this->model_permohonan->get_data();


        return view($this->path . '/view', $data);
    }


    public function export()
    {


        $id_permohonan  = $this->request->getPost('tblizinpermohonan_id');
        $w['tblizin_id'] = $this->request->getPost('tblizin_id');
        $w['tblizinpermohonan_id'] = $id_permohonan;
        $w['tblizinpendaftaran_issign'] = 'T';
        if ($this->request->getPost('dari')) {
            $w['tblizinpendaftaran_tgljam >=']  = $this->request->getPost('dari');
        }

        if ($this->request->getPost('sampai')) {
            $w['tblizinpendaftaran_tgljam <=']  = $this->request->getPost('sampai');
        }

        $rows = $this->model_pendaftaran->get_data($w);
        $tabel = $this->model_template->get_table_by_id_permohonan($id_permohonan);
        $tabel_info = $this->model_variabel->get_table_info($tabel['tblskizin_tabelvariabel_id']);

        $data = array();
        $no = 1;
        foreach ($rows as $row) {

            $r['no'] = $no;
            $r['nama'] = $row['tblizinpendaftaran_namapemohon'];
            $r['alamat'] = $row['tblizinpendaftaran_almtpemohon'];
            $r['nama_usaha'] = $row['tblizinpendaftaran_usaha'];
            $r['alamat_usaha'] = $row['tblizinpendaftaran_lokasiizin'];
            $r['nik'] = $row['tblizinpendaftaran_idpemohon'];
            $r['npwp'] = $row['tblizinpendaftaran_npwp'];
            $r['kecamatan'] = $row['tblkecamatan_nama'];
            $r['kelurahan'] = $row['tblkelurahan_nama'];
            $r['pemohonan'] = $row['tblizinpermohonan_nama'];
            $r['tgl_daftar'] = $row['tblizinpendaftaran_tgljam'];
            $d = $this->model_template->get_row_tertentu($tabel['tblskizin_tabelsk'], $row['tblizinpendaftaran_id']);
            foreach ($tabel_info as $key => $t) {
                if ($key > 1) {


                    if ($t->type_name == 'date') {
                        $r[$t->name] = isset($d[$t->name]) ? tanggal($d[$t->name])  : '';
                    } else {
                        $r[$t->name] =  isset($d[$t->name]) ? $d[$t->name] : '';
                    }
                }
            }
            $no++;
            $data[] = $r;
        }


        return view($this->path . '/export', array('rows' => $data, 'tabel' => $tabel_info));
    }
}
