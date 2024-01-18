<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Controllers\BaseController;
use App\Models\M_pendaftaran;
use App\Models\M_persyaratan_pemohon;
use PhpOffice\PhpWord\TemplateProcessor;

class Dev extends BaseController
{

    protected $db;
    protected $dt;

    protected $model_persyaratan_pemohon;
    protected $model_pendaftatan;


    public function __construct()
    {
        $this->db = db_connect();
        $this->request = Services::request();
        $this->model_persyaratan_pemohon = new  M_persyaratan_pemohon($this->request);
        $this->model_pendaftatan = new M_pendaftaran($this->request);
    }


    public function index()
    {
        // input persyaratan pemohon online
        $query = "SELECT * FROM tblpemohonpersyaratan2";
        $row = $this->db->query($query)->getResultArray();

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
                $this->model_persyaratan_pemohon->insert($data);
            }
        }
    }


    public function pendaftaran_migrasi()
    {
        $query = "SELECT * FROM tblizinpendaftaran_migrasi";
        $row = $this->db->query($query)->getResultArray();
       
        $i = 0;
        foreach ($row as $r) {

            $nr = $this->model_pendaftatan->get_by_pendaftaran_nomor($r['tblizinpendaftaran_nomor']);
         

            if(!$nr){
                
             
                $in = $this->model_pendaftatan->insert($r);
                
                if($in){
                    $i++;
                   dd($r);
                }
                   
            }

          
            
        
        }

        echo 'Terinput '.$i. ' data';
    }
}