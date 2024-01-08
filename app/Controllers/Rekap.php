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
    protected $model_kendali_proses;
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
        $this->model_kendali_proses = new M_kendali_proses($this->request);
    }


    public function index()
    {


        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['izin'] = $this->model_kendali_proses->get_izin_by_blok_sistem();
        // $data['kecamatan'] = $this->model_kecamatan->findAll();



        return view($this->path . '/view', $data);
    }

    public function per_tahun()
    {


        $data['title'] = $this->page . ' Per Tahun';
        $data['page'] = $this->page . ' Per Tahun';
        $data['url'] = $this->url . '/per_tahun';
        $data['path'] = $this->path;
        // $data['izin'] = $this->model_kendali_proses->get_izin_by_blok_sistem();
        // $data['kecamatan'] = $this->model_kecamatan->findAll();



        return view($this->path . '/per_tahun/view', $data);
    }


    public function per_kecamatan()
    {


        $data['title'] = $this->page . ' Per Kecamatan';
        $data['page'] = $this->page . ' Per Kecamatan';
        $data['url'] = $this->url . '/per_kecamatan';
        $data['path'] = $this->path;
        // $data['izin'] = $this->model_kendali_proses->get_izin_by_blok_sistem();
        // $data['kecamatan'] = $this->model_kecamatan->findAll();



        return view($this->path . '/per_kecamatan/view', $data);
    }

    public function get_data()
    {


        $lists = $this->model->getDatatables();
        $data = [];
        $no = $this->request->getPost('start');
        $str =  $this->request->getPost('str');
        foreach ($lists as $l) {
            $no++;
            $row = [];
            $row[] = $no . '.';

            $draf_sk = 'doc/before_tte/' . $l['tblizinpendaftaran_id'] . '.pdf';
            $sk = 'doc/sign/' . $l['tblizinpendaftaran_id'] . '.pdf';

            $opsi = '<div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">';



            if (file_exists($sk)) {
                $opsi .= '<li><a class="dropdown-item"  href="#" onclick="review(\'' . $sk . '\')">Lihat SK</a>
                </li>';
            }

            if (file_exists($draf_sk)) {
                $opsi .= '<li><a class="dropdown-item"  href="#" onclick="review(\'' . $draf_sk . '\')">Lihat Draf SK</a>
            </li>';
            }

            if ($l['tblizinpendaftaran_issign'] == 'T') {
                $opsi .=  '<li><a class="dropdown-item" href="' . site_url('cetak_sk/form_page/' . $l['tblizinpendaftaran_id']) . '"  >Cetak Ulang</a>
            </li>';
            }

            $opsi .= '<li><a class="dropdown-item"  href="#" onclick="log(\'' . $l['tblizinpendaftaran_id'] . '\')">Log Berkas</a>
            </li>
               
             
            </div>';

            $row[] = $opsi;
            // $row[] = '<div class="text-wrap">' . status_sk($l['tblizinpendaftaran_issign']) . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_nomor'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_namapemohon'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_usaha'] . '</div>';

            $row[] = '<div class="text-wrap">' . tanggal($l['tblizinpendaftaran_tgljam']) . '</div>';
            $row[] = $l['tblkecamatan_nama'];
            $row[] = $l['tblkelurahan_nama'];



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

    public function export_per_tahun()
    {
        $tahun = $this->request->getPost('tahun');
        $w['YEAR(tgl_daftar) ='] = $tahun;
        $w['tblizinpendaftaran_issign'] = 'T';
        $izin =  $this->model_kendali_proses->get_izin_by_blok_sistem();

        $data = array();


        foreach ($izin as $i) {

            $r['nama_izin'] = $i['tblizin_nama'];
            $w['tblizin_id'] = $i['tblizin_id'];

            foreach (bulan() as $key => $b) {
                $w['MONTH(tgl_daftar) ='] = $key;
                $row = $this->model_pendaftaran->get_num_rows($w);
                $r[$key] = $row;
            }

            $data[] = $r;
        }



        return view($this->path . '/per_tahun/export', array('rows' => $data));
    }

    public function export_per_kecamatan()
    {

        $w['tgl_daftar >=']  = $this->request->getPost('dari');
        $w['tgl_daftar <=']  = $this->request->getPost('sampai');
        $w['tblizinpendaftaran_issign'] = 'T';
        $izin =  $this->model_kendali_proses->get_izin_by_blok_sistem();
        $kec = $this->model_kecamatan->findAll();
        // dd($kec);

        $data = array();


        foreach ($izin as $i) {

            $r['nama_izin'] = $i['tblizin_nama'];
            $w['tblizin_id'] = $i['tblizin_id'];

            foreach ($kec as  $k) {
                $w['tblkecamatan_id'] = $k['tblkecamatan_id'];
                $row = $this->model_pendaftaran->get_num_rows($w);
                $r[$w['tblkecamatan_id']] = $row;
            }

            $data[] = $r;
        }

        // dd($data);

        return view($this->path . '/per_kecamatan/export', array('rows' => $data, 'kec' => $kec));
    }

    public function export()
    {


        $id_permohonan  = $this->request->getPost('tblizinpermohonan_id');
        $w['tblizin_id'] = $this->request->getPost('tblizin_id');
        $w['tblizinpermohonan_id'] = $id_permohonan;
        $w['tblizinpendaftaran_issign'] = 'T';
        if ($this->request->getPost('dari')) {
            $w['tgl_daftar >=']  = $this->request->getPost('dari');
        }

        if ($this->request->getPost('sampai')) {
            $w['tgl_daftar <=']  = $this->request->getPost('sampai');
        }

        $rows = $this->model_pendaftaran->get_data($w);



        $tabel = $this->model_template->get_table_by_id_permohonan($id_permohonan);
        $tabel_info = $this->model_variabel->get_table_info($tabel['tblskizin_tabelvariabel_id']);


        $spreadsheet = new Spreadsheet();
        $no = 1;
        $baris = 2;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NAMA');
        $sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'NPWP');
        $sheet->setCellValue('E1', 'TELEPON');
        $sheet->setCellValue('F1', 'ALAMAT');
        $sheet->setCellValue('G1', 'NAMA USAHA');
        $sheet->setCellValue('H1', 'ALAMAT USAHA');


        $alfabet = 8;
        foreach ($tabel_info as $key => $t) {

            if ($key > 1) {
                $sheet->setCellValue(alfabet($alfabet) . '1', strtoupper(str_replace("_", " ", $t->name)));
                $alfabet++;
            }
        }


        foreach ($rows as $row) {
            $alfabet = 8;
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $row['tblizinpendaftaran_namapemohon']);
            $sheet->setCellValue('C' . $baris, "'" . $row['tblizinpendaftaran_idpemohon']);
            $sheet->setCellValue('D' . $baris, "'" . $row['tblizinpendaftaran_npwp']);
            $sheet->setCellValue('E' . $baris, $row['tblizinpendaftaran_telponpemohon']);
            $sheet->setCellValue('F' . $baris, $row['tblizinpendaftaran_almtpemohon']);
            $sheet->setCellValue('G' . $baris, $row['tblizinpendaftaran_usaha']);
            $sheet->setCellValue('H' . $baris, $row['tblizinpendaftaran_lokasiizin']);


            $d = $this->model_template->get_row_tertentu($tabel['tblskizin_tabelsk'], $row['tblizinpendaftaran_id']);

            foreach ($tabel_info as $key => $t) {


                if ($key > 1) {
                    if ($t->type_name == 'date') {
                        $val = isset($d[$t->name]) ? tanggal($d[$t->name])  : '';
                    } else {
                        $val =  isset($d[$t->name]) ? $d[$t->name] : '';
                    }
                    $sheet->setCellValue(alfabet($alfabet) . $baris, $val);
                    $alfabet++;
                }
            }

            $no++;
            $baris++;
        }


        $tanggal = '';
        if ($this->request->getPost('dari') != ''  && $this->request->getPost('sampai') != '') {
            $tanggal  = ' ' . $this->request->getPost('dari') . ' - ' . $this->request->getPost('sampai');
        }

        $per = $this->model_permohonan->find($id_permohonan);
        $nama_file = $per['tblizinpermohonan_nama'] .  $tanggal . '.xlsx';
        $this->response
            ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->setHeader('Content-Disposition', 'attachment;filename="' . $nama_file . '"')
            ->setHeader('Cache-Control', 'max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}