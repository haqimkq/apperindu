<?php

namespace App\Controllers;

use App\Models\M_kendali_proses;
use App\Models\M_pendaftaran;
use App\Models\Master\M_izin;
use App\Models\Master\M_permohonan;
use App\Models\Master\M_template_rekomendasi;
use App\Models\Master\M_variabel_sk;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rekap_rekomendasi extends BaseController
{

    private $page = 'Rekap Rekomendasi';
    private $url = 'rekap_rekomendasi';
    private $path = 'rekap_rekomendasi';

    protected $model;
    protected $model_izin;
    protected $model_permohonan;
    protected $model_kendali_proses;
    protected $primaryKey       = 'tblkendaliproses_id';
    protected $model_pendaftaran;
    protected $model_template;
    protected $model_variabel;
    protected $request;

    public function __construct()
    {
        $this->request = Services::request();
        $this->model = new M_kendali_proses($this->request);
        $this->model_izin = new M_izin($this->request);
        $this->model_permohonan = new M_permohonan($this->request);
        $this->model_kendali_proses = new M_kendali_proses($this->request);
        $this->model_pendaftaran = new M_pendaftaran($this->request);
        $this->model_template = new M_template_rekomendasi($this->request);
        $this->model_variabel = new M_variabel_sk($this->request);
    }


    public function index()
    {


        $data['title'] = $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        $data['izin'] = $this->model_kendali_proses->get_izin_by_blok_sistem();



        return view($this->path . '/view', $data);
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
            $rekom = 'doc/sign/rekomendasi_' . $l['tblizinpendaftaran_id'] . '.pdf';
            $opsi = '<div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Opsi</button>
            <ul class="dropdown-menu">';

            $opsi .= '<li><a class="dropdown-item"  href="#" onclick="review(\'' . $rekom . '\')">Lihat Rekomendasi</a>
            </li>';
            $opsi .= '<li><a class="dropdown-item"  href="#" onclick="log(\'' . $l['tblizinpendaftaran_id'] . '\')">Log Berkas</a>
            </li>
               
             
            </div>';

            $row[] = $opsi;
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_nomor'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_namapemohon'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_usaha'] . '</div>';

            $row[] = '<div class="text-wrap">' . tanggal($l['tblkendaliproses_tglterima']) . '</div>';




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

    public function export()
    {


        $id_permohonan  = $this->request->getPost('tblizinpermohonan_id');
        $w['tblizin_id'] = $this->request->getPost('tblizin_id');
        $w['tblizinpermohonan_id'] = $id_permohonan;

        if ($this->request->getPost('dari')) {
            $w['tblizinpendaftaran_tgljam >=']  = $this->request->getPost('dari');
        }

        if ($this->request->getPost('sampai')) {
            $w['tblizinpendaftaran_tgljam <=']  = $this->request->getPost('sampai');
        }

        $rows = $this->model_pendaftaran->get_data($w);



        $tabel = $this->model_template->get_by_id_permohonan($id_permohonan);
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
        $nama_file = 'Rekomendasi ' . $per['tblizinpermohonan_nama'] .  $tanggal . '.xlsx';
        $this->response
            ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->setHeader('Content-Disposition', 'attachment;filename="' . $nama_file . '"')
            ->setHeader('Cache-Control', 'max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}