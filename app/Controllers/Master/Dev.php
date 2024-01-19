<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Controllers\BaseController;
use App\Models\M_pendaftaran;
use App\Models\M_persyaratan_pemohon;
use App\Models\M_pemohon;
use PhpOffice\PhpWord\TemplateProcessor;

class Dev extends BaseController
{

    protected $db;
    protected $dt;

    protected $model_persyaratan_pemohon;
    protected $model_pendaftatan;
    protected $model_pemohon;


    public function __construct()
    {
        $this->db = db_connect();
        $this->request = Services::request();
        $this->model_persyaratan_pemohon = new  M_persyaratan_pemohon($this->request);
        $this->model_pendaftatan = new M_pendaftaran($this->request);
        $this->model_pemohon =  new M_pemohon($this->request);
    }


    public function index()
    {
        // input persyaratan pemohon online
        $query = "SELECT * FROM tblpemohonpersyaratan_migrasi";
        $row = $this->db->query($query)->getResultArray();
        $i = 0;
        foreach ($row as $r) {
            $query = 'SELECT * FROM tblpemohon WHERE tblpemohon_idonline = ' . $r['tblpemohon_id'];
            $d =  $this->db->query($query)->getRowArray();
            $data['tblpemohon_id'] = $d['tblpemohon_id'];
            $data['tblizinpendaftaran_id'] = 0;
            $data['tblpersyaratan_id'] = $r['tblpersyaratan_id'];
            $data['tblpemohonpersyaratan_file'] = $r['tblpemohonpersyaratan_file'];
            $data['tblpemohonpersyaratan_keterangan'] = $r['tblpemohonpersyaratan_keterangan'];

            $query = 'SELECT * FROM tblpemohonpersyaratan WHERE tblpemohon_id = ' . $d['tblpemohon_id'] . ' AND  tblpersyaratan_id = ' . $r['tblpersyaratan_id'];
            $n =  $this->db->query($query)->getNumRows();

            if (!$n && $r['tblpemohonpersyaratan_file']) {
                $in =  $this->model_persyaratan_pemohon->insert($data);
                if ($in) {
                    $i++;
                }
            }
        }
        echo 'Terinput ' . $i . ' data';
    }


    public function pendaftaran_migrasi()
    {
        $query = "SELECT * FROM tblizinpendaftaran_migrasi";
        $row = $this->db->query($query)->getResultArray();

        $i = 0;

        foreach ($row as $r) {
            unset($r['tblizinpendaftaran_id']);
            $nr = $this->model_pendaftatan->get_by_pendaftaran_nomor_($r['tblizinpendaftaran_nomor']);

            if (!$nr) {
                $in = $this->model_pendaftatan->insert($r);
                if ($in) {
                    $i++;
                }
            }
        }
        echo 'Terinput ' . $i . ' data';
    }


    public function  pemohon_migrasi()
    {
        $query = "SELECT * FROM tblpemohon_migrasi";
        $row = $this->db->query($query)->getResultArray();

        $i = 0;

        foreach ($row as $r) {

            $nr = $this->model_pemohon->where(['tblpemohon_id' => $r['tblpemohon_id']])->first();


            if (!$nr) {
                $in = $this->model_pemohon->insert($r);
                if ($in) {
                    $i++;
                }
            }
        }
        echo 'Terinput ' . $i . ' data';
    }
}
