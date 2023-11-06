<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengaturan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengaturan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nip_kadis',
        'nik_kadis',
        'nama_kadis',
        'pangkat_kadis',
        'token_wa',
        'token_tte',
        'redaksi_ditolak',
        'redaksi_diterima',
        'redaksi_tte',
        'wa_testing'
    ];


    public function allowedfields()
    {
        return $this->allowedFields;
    }

    public function get_row()
    {
        return $this->where(['status' => 'T'])->first();
    }

    public function replaceTemplateVariables($template, $data)
    {
        foreach ($data as $key => $value) {
            $template = str_replace("{{" . $key . "}}", $value, $template);
        }
        return $template;
    }

    public function variable_dummy()
    {
        $data = [
            'tgl_permohonan' => replace_variable('tgl_permohonan'),
            'nama_pemohon' => replace_variable('nama_pemohon'),
            'alamat_pemohon' => replace_variable('alamat_pemohon'),
            'nama_usaha' => replace_variable('nama_usaha'),
            'alamat_usaha' => replace_variable('alamat_usaha'),
            'nik' => replace_variable('nik'),
            'npwp' => replace_variable('npwp'),
            'no_pendaftaran' => replace_variable('no_pendaftaran'),
            'alasan' => replace_variable('alasan'),
            'link_dokumen_digital' => replace_variable('link_dokumen_digital'),
        ];

        return $data;
    }
}