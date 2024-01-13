<?php

namespace App\Models;

use CodeIgniter\Model;
use FontLib\Table\Type\name;

class M_doc extends Model
{
    public function processRTFTemplate($templateFile, $outputFile, $templateVariables)
    {
        // Membaca isi file template RTF
        $templateContent = file_get_contents($templateFile);

        // Mengganti variabel dalam template
        foreach ($templateVariables as $variable => $value) {
            $templateContent = str_replace('$' . $variable, $value, $templateContent);
        }

        // Menyimpan file output RTF
        file_put_contents($outputFile, $templateContent);
    }


    // public function word2pdf($file, $path)
    // {


    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'http://103.165.243.16:8080/word2pdf/api/convert-to-pdf.php',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',

    //         CURLOPT_POSTFIELDS => array('sendimage' => new \CURLFILE($file)),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     $res = json_decode($response);



    //     if ($res->status) {
    //         $url = 'http://103.165.243.16:8080/word2pdf/upload/' . $res->filename;
    //         $file_name = basename($url);
    //         file_put_contents($path . $file_name, file_get_contents($url));
    //         return  $res->filename;
    //     }

    //     return false;
    // }

    public function word2pdf($file, $path)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.165.243.60:7101/converter.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('file' => new \CURLFILE($file)),
        ));

        $response = curl_exec($curl);

        $res = json_decode($response, true);

        if ($res['status'] == 200) {
            $file_name = ($file);
            $info = pathinfo($file_name);

            $file_name = $info['filename'] . '.pdf';

            $pdfContent = base64_decode($res['file_base64']);
            $put =  file_put_contents($path . $file_name, $pdfContent);
            if ($put) {
                return $file_name;
            }
        }

        return false;
    }

    public function get_img($imagePath, $size = array())
    {
        if (!file_exists($imagePath)) {
            return '';
        }
        $b = fopen($imagePath, "rb");
        // var_dump($b);
        if (!$b) {
            return '';
        }

        $imgData = getimagesize($imagePath);
        $scalex = 100;
        $scaley = 100;

        if (count($size) > 0) {
            // $size['width'] & $size['height'] is in cm
            $imgData[0] = (isset($size['width']) && $size['width'] != 0) ? $size['width'] * 565 : $imgData[0];
            $imgData[1] = (isset($size['height']) && $size['height'] != 0) ? $size['height'] * 565 : $imgData[1];
            $scalex = (isset($size['scalex']) && $size['scalex'] != 0) ? intval($size['scalex']) : 100; //default = 100
            $scaley = (isset($size['scaley']) && $size['scaley'] != 0) ? intval($size['scaley']) : 100; //default = 100

            $imgData[0] = intval($imgData[0]);
            $imgData[1] = intval($imgData[1]);
        }

        $ext = explode('.', $imagePath);
        $ext = array_reverse($ext);
        $ext = strtolower($ext[0]);

        $imgb = "jpegblip";
        if ($ext == 'png') {
            $imgb = "pngblip";
        }

        // $newImagePre="{\\*\\shppict{\\pict \\pngblip \\picw".$imgData[0]." \\pich".$imgData[1]."\\picwgoal".$imgData[0]."\\pichgoal".$imgData[1]."\\picscalex".$scalex."\\picscaley".$scaley." \\wbmbitspixel24 "; 
        $newImagePre = "{\\*\\shppict{\\pict \\{$imgb} \\picw" . $imgData[0] . " \\pich" . $imgData[1] . "\\picwgoal" . $imgData[0] . "\\pichgoal" . $imgData[1] . "\\picscalex" . $scalex . "\\picscaley" . $scaley . " \\wbmbitspixel24 ";
        $newImage = '';
        while (!feof($b)) {
            $newImage .= fgets($b);
        }
        $hex = bin2hex($newImage);
        $imgData = $newImagePre . $hex . "}}";

        return $imgData;
    }

    public function qrcode($text, $outputFile)
    {
        // Mengimpor library phpqrcode
        require_once APPPATH . 'ThirdParty/phpqrcode/qrlib.php';

        // Teks yang akan diubah menjadi kode QR
        // Konfigurasi kode QR
        $errorCorrectionLevel = 'H'; // L = Low, M = Medium, Q = Quartile, H = High
        $matrixPointSize = 10; // Ukuran titik pada kode QR
        $margin = 0;

        // Menghasilkan kode QR
        \QRcode::png($text, $outputFile, $errorCorrectionLevel, $matrixPointSize, $margin);

        // Mengembalikan nama file
        return $outputFile;
    }

    public function tte($id, $file, $name, $nik, $passphrase)
    {
        $curl = curl_init();

        $arr = array(
            'file' =>  new \CURLFILE($file, 'application/pdf', $name),
            'nik' =>  $nik,
            'tampilan' => 'invisible',
            'passphrase' => $passphrase,
            'location' => $id, //untuk identifikasi id pendaftaran 
            'reason' => 'Identifikasi Izin'

        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.165.243.76/api/sign/pdf',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $arr,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ZWdvdjphcHJpbG51cmlsY2FudGlr',
                'Cookie: JSESSIONID=FDC44C13A272E3F70AB36A6F38BCB455'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function send_wa($msg, $number, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pati.wablas.com/api/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('phone' => $number, 'message' => $msg),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;;
    }

    public function verify($file, $name)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => '103.165.243.76/api/sign/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('signed_file' =>  new \CURLFILE($file, 'application/pdf', $name)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ZWdvdjphcHJpbG51cmlsY2FudGlr',
                'Cookie: JSESSIONID=E286578CC81C88A64794928EB7E3674C'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }


    public function encrypt($message, $key)
    {
        $iv = "k7ha41m9sh126shw";

        $encrypted = openssl_encrypt($message, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        $base64 = str_replace(array('+', '/', '%'), array('-', '_', ''), base64_encode($encrypted));
        return $base64;
    }

    public  function decrypt($encrypted_message, $key)
    {
        $iv = "k7ha41m9sh126shw";

        $data = base64_decode(str_replace(array('-', '_'), array('+', '/'), $encrypted_message));
        return openssl_decrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    }
}
