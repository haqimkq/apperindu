<?php

namespace App\Controllers\Master;

use Config\Services;
use App\Controllers\BaseController;
use PhpOffice\PhpWord\TemplateProcessor;

class Dev extends BaseController
{


    public function __construct()
    {
        $this->request = Services::request();
    }


    public function index()
    {

        $templateFile = base_url('doc/template.docx');
        $outputFile = 'C:/xampp74/htdocs/ptsp/doc/sk.docx';


        $data = [
            'nama_usaha' => 'John Doe',
            'nama_penanggungjawab' => 'Jl. Contoh No. 123',
            'lokasi' => 'Jl. Contoh No. 123',
            'modal' => ''
        ];

        $templateProcessor = new TemplateProcessor($templateFile);
        $templateProcessor->setValues($data);
        $templateProcessor->saveAs($outputFile);


        $this->response->download($outputFile, null);
    }


    public function pengguna_new()
    {
        $m_pengguna =  new \App\Models\Master\M_pengguna($this->request);
        $m_pengguna_old =  new \App\Models\Master\M_pengguna_old();

        $pengguna_old = $m_pengguna_old->findAll();
        foreach ($pengguna_old as $p) {

            $d = array(
                'username' => $p['tblpengguna_id'],
                'tblpengguna_password' =>  password_hash($p['tblpengguna_password'], PASSWORD_DEFAULT),
                'tblpengguna_nama' => $p['tblpengguna_nama'],
                'tblpengguna_unitkerja' => $p['tblpengguna_unitkerja'],
                'tblkendalibloksistem_id' => $p['tblkendalibloksistem_id'],
                'tblantriangroup_id' => $p['tblantriangroup_id'],
                'tblpengguna_nip' => $p['tblpengguna_nip'],
                'tblpengguna_jabatan' => $p['tblpengguna_jabatan']

            );

            $m_pengguna->save($d);
        }
    }
}
