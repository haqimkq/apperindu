<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Controllers\BaseController;
use App\Models\M_pendaftaran;
use App\Models\M_persyaratan_pemohon;
use App\Models\M_pemohon;
use App\Models\Master\M_persyaratan_permohonan;
use PhpOffice\PhpWord\TemplateProcessor;

class Dev extends BaseController
{

    protected $db;
    protected $dt;

    protected $model_persyaratan_pemohon;
    protected $model_pendaftatan;
    protected $model_pemohon;
    protected $model_persyaratan;


    public function __construct()
    {
        $this->db = db_connect();
        $this->request = Services::request();
        $this->model_persyaratan_pemohon = new  M_persyaratan_pemohon($this->request);
        $this->model_pendaftatan = new M_pendaftaran($this->request);
        $this->model_pemohon =  new M_pemohon($this->request);
        $this->model_persyaratan = new M_persyaratan_permohonan($this->request);
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
                $in = $this->model_pendaftatan->save($r);
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
                $in = $this->db->table('tblpemohon')->insert($r);
                if ($in) {
                    $i++;
                }
            }
        }
        echo 'Terinput ' . $i . ' data';
    }

    public function persyaratan_sik()
    {
        $id = 241;
        $id_permohonan = array(289);
        $rows = $this->model_persyaratan->get_persyaratan_by_id_permohonan($id)->get()->getResultArray();
        $i = 0;
        foreach ($id_permohonan as $ip) {

            foreach ($rows as $row) {
                $data['tblizin_id'] = $row['tblizin_id'];
                $data['tblizinpermohonan_id'] = $ip;
                $data['tblizinpersyaratan_urut'] = $row['tblizinpersyaratan_urut'];
                $data['tblpersyaratan_id'] = $row['tblpersyaratan_id'];
                $data['tblizinpersyaratan_isaktif'] = $row['tblizinpersyaratan_isaktif'];
                $in =   $this->model_persyaratan->save($data);
                if ($in) {
                    $i++;
                }
            }
        }

        echo 'Terinput ' . $i . ' data';
    }
}
