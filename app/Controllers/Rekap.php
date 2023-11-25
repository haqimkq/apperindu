<?php

namespace App\Controllers;

use App\Models\M_kendali_proses;
use App\Models\Master\M_izin;
use App\Models\Master\M_kecamatan;
use App\Models\Master\M_permohonan;
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
    protected $primaryKey       = 'tblkendaliproses_id';
    protected $model_blok_sistem_tugas;
    protected $request;

    public function __construct()
    {
        $this->request = Services::request();
        $this->model = new M_kendali_proses($this->request);
        $this->model_izin = new M_izin($this->request);
        $this->model_permohonan = new M_permohonan($this->request);
        $this->model_kecamatan = new M_kecamatan($this->request);
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

            $opsi .= '<li><a class="dropdown-item"  href="#" onclick="review(\'' . $draf_sk . '\')">Lihat Draf SK</a>
            </li>';

            if ($l['tblizinpendaftaran_issign'] == 'T') {
                $opsi .= '<li><a class="dropdown-item"  href="#" onclick="review(\'' . $sk . '\')">Lihat SK</a>
                </li>';
            }

            $opsi .=  '<li><a class="dropdown-item" href="' . site_url('cetak_sk/form_page/' . $l['tblizinpendaftaran_id']) . '"  >Cetak Ulang</a>
            </li>';

            $opsi .= '<li><a class="dropdown-item"  href="#" onclick="log(\'' . $l['tblizinpendaftaran_id'] . '\')">Log Berkas</a>
            </li>
               
             
            </div>';

            $row[] = $opsi;
            $row[] = '<div class="text-wrap">' . status_sk($l['tblizinpendaftaran_issign']) . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_nomor'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizin_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpermohonan_nama'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_namapemohon'] . '</div>';
            $row[] = '<div class="text-wrap">' . $l['tblizinpendaftaran_usaha'] . '</div>';

            $row[] = '<div class="text-wrap">' . tanggal($l['tblkendaliproses_tglterima']) . '</div>';
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

    public function export()
    {

        $datas = $this->model->export();


        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Add data to the spreadsheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nomor Pendaftaran');
        $sheet->setCellValue('C1', 'Nama Izin');
        $sheet->setCellValue('D1', 'Nama Permohonan');
        $sheet->setCellValue('E1', 'Nama Pemohon');
        $sheet->setCellValue('F1', 'Tanggal Daftar');
        $sheet->setCellValue('G1', 'Kecamatan');
        $sheet->setCellValue('H1', 'Kelurahan');
        $sheet->setCellValue('I1', 'Status');

        // Loop through database results and populate the spreadsheet
        $row = 2;
        $no = 1;
        foreach ($datas as $data) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $data['tblizinpendaftaran_nomor']);
            $sheet->setCellValue('C' . $row, $data['tblizin_nama']);
            $sheet->setCellValue('D' . $row, $data['tblizinpermohonan_nama']);
            $sheet->setCellValue('E' . $row, $data['tblizinpendaftaran_namapemohon']);
            $sheet->setCellValue('F' . $row, tanggal($data['tblizinpendaftaran_tgljam']));
            $sheet->setCellValue('G' . $row, $data['tblkecamatan_nama']);
            $sheet->setCellValue('H' . $row, $data['tblkelurahan_nama']);
            $sheet->setCellValue('I' . $row, status_sk($data['tblizinpendaftaran_issign']));

            $no++;
            $row++;
        }

        // Set the header for the downloaded file
        $this->response
            ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->setHeader('Content-Disposition', 'attachment;filename="exported_data.xlsx"')
            ->setHeader('Cache-Control', 'max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
