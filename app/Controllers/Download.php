<?php


namespace App\Controllers;


use App\Models\M_doc;
use App\Models\M_pendaftaran;
use Config\Services;


class Download extends BaseController
{


    protected $model_pendaftaran;
    protected $model_doc;
    protected $request;



    public function __construct()
    {
        $this->request = Services::request();
        $this->model_pendaftaran = new M_pendaftaran($this->request);
        $this->model_doc = new M_doc();
    }

    public function public($str)
    {

        $id = $this->model_doc->decrypt($str, key_secret());

        $file_path = sign($id . '.pdf'); // Replace this with the actual path to your file
        $r = $this->model_pendaftaran->get_by_id($id);

        $name = $r['tblizinpendaftaran_namapemohon'] . ' - ' . $r['tblizin_nama'] . '.pdf';
        // Check if the file exists and is readable
        if (file_exists($file_path) && is_readable($file_path)) {
            // Set the headers for file download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $name . '"');
            header('Content-Length: ' . filesize($file_path));

            // Clear any output buffers that may have been opened
            ob_clean();
            flush();

            // Read the file and send its contents to the client
            readfile($file_path);
            exit;
        } else {
            // Handle the case when the file is not found or not readable
            echo "File not found or cannot be accessed.";
        }
    }
}