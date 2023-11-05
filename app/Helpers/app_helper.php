<?php

use PhpParser\Node\Stmt\Return_;

function status_aktif($str)
{
    if ($str == 'T') {
        return  '<span class="badge bg-success">Aktif</span>';
    }

    return  '<span class="badge bg-danger">Tidak Aktif</span>';
}

function pendaftaran($id)
{
    if ($id) {
        return 'Online';
    }

    return 'Loket';
}


function status_pendaftaran($str)
{
    if ($str == 'T') {
        return  '<span class="badge bg-success">Selesai</span>';
    }

    return  '<span class="badge bg-warning">Proses</span>';
}

function status_online($str)
{
    if ($str == 2) {
        return  '<span class="badge bg-danger">Ditolak</span>';
    }

    if ($str == 4) {
        return  '<span class="badge bg-success">Selesai</span>';
    }

    return  '<span class="badge bg-warning">Diproses</span>';
}

function selected($x, $y)
{

    if ($x != $y) {
        return '';
    }

    return 'selected';
}

function status_aktif_ar()
{
    $str = [array('val' => 'T', 'cap' => 'Aktif'), array('val' => 'F', 'cap' => 'Tidak Aktif')];
    return $str;
}

function status_kendali_berkas($str)
{
    if ($str == 4) {
        return 'Diproses';
    }

    if ($str == 2) {
        return 'Sudah dikirim';
    }

    if ($str == 10) {
        return 'Ditolak';
    }

    return 'Sudah diproses';
}

function is_rekom($str)
{
    if ($str == 'T') {
        return 'Rekomendasi';
    }

    return 'Surat Keterangan';
}

function success_add()
{
    return 'Berhasil ditambahkan';
}

function success_update()
{
    return 'Berhasil diubah';
}


function success_delete()
{
    return 'Berhasil dihapus';
}


function success_bulk()
{
    return 'Opsi sekaligus berhasil ';
}

function failed()
{
    return 'Terjadi Kesalahan';
}

function get_blok_sistem_type_1()
{
    $arr = [124, 128, 127, 129, 125, 126, 132, 133, 134, 135, 136, 137, 139, 140, 138, 144];

    return $arr;
}

function get_blok_sistem_type_2()
{
    // pendaftaran
    $arr = [1, 2, 3];

    return $arr;
}


function get_blok_sistem_type_3()
{
    // BO Usaha 1
    // BO Usaha 2
    // BO Tertentu 1
    // BO Tertentu 2

    $arr = [5, 6, 7, 8];
    return $arr;
}

function get_blok_sistem_type_4()
{
    // BO Usaha 1
    // BO Usaha 2
    // BO Tertentu 1
    // BO Tertentu 2

    $arr = [132, 133, 134, 135, 136, 137, 138, 139, 140, 148, 149];
    return $arr;
}

function get_blok_sistem_type_5()
{


    $arr = [124, 5, 147, 6, 7, 8, 128, 129, 125, 127, 126, 130, 132, 134, 133, 135, 136, 137, 138, 139, 140, 141, 142, 143, 143, 144, 148, 149];
    return $arr;
}


function get_izin_type_1()
{
    $arr = [5, 10, 17, 33];

    return $arr;
}

function tanggalhari($tgl)
{
    $tanggal = strtotime($tgl);
    $hari = date('w', $tanggal);
    switch ($hari) {
        case 0:
            $hari = 'Minggu';
            break;
        case 1:
            $hari = 'Senin';
            break;
        case 2:
            $hari = 'Selasa';
            break;
        case 3:
            $hari = 'Rabu';
            break;
        case 4:
            $hari = 'Kamis';
            break;
        case 5:
            $hari = 'Jum\'at';
            break;
        case 6:
            $hari = 'Sabtu';
            break;
    }

    $tanggal = tanggal($tgl);
    return $hari . ', ' . $tanggal;
}


function tanggal($tgl)
{
    $tanggal = strtotime($tgl);
    $bulan = date('n', $tanggal);
    switch ($bulan) {
        case 1:
            $bulan = 'Januari';
            break;
        case 2:
            $bulan = 'Februari';
            break;
        case 3:
            $bulan = 'Maret';
            break;
        case 4:
            $bulan = 'April';
            break;
        case 5:
            $bulan = 'Mei';
            break;
        case 6:
            $bulan = 'Juni';
            break;
        case 7:
            $bulan = 'Juli';
            break;
        case 8:
            $bulan = 'Agustus';
            break;
        case 9:
            $bulan = 'September';
            break;
        case 10:
            $bulan = 'Oktober';
            break;
        case 11:
            $bulan = 'Nopember';
            break;
        case 12:
            $bulan = 'Desember';
            break;
    }
    return date('j', $tanggal) . ' ' . $bulan . ' ' . date('Y', $tanggal);
}

function public_path()
{
    $r = realpath($_SERVER["DOCUMENT_ROOT"]);
    return $r . '/ptsp/';
}

function word_dir($str)
{

    return public_path() . 'doc/word/' . $str;
}


function qr_dir()
{

    return public_path() . 'assets/images/qr.png';
}


function pas_foto_dir()
{

    return public_path() . 'assets/images/pas_foto.png';
}


function qr_gen_dir()
{

    return public_path() . 'assets/images/qr_code.png';
}

function before_tte($str = null)

{

    $url = 'doc/before_tte/';

    if (!$str) {
        return public_path() . $url;
    }

    return public_path() . $url . $str;
}


function template_dir($str)

{
    return public_path() . 'doc/template/' . $str;
}


function sign($str = null)

{

    $url = 'doc/sign/';

    if (!$str) {
        return public_path() . $url;
    }

    return public_path() . $url . $str;
}




function unsign($str = null)

{

    $url = 'doc/unsign/';

    if (!$str) {
        return public_path() . $url;
    }

    return public_path() . $url . $str;
}


function tmp($str = null)

{

    $url = 'doc/tmp/';

    if (!$str) {
        return public_path() . $url;
    }

    return public_path() . $url . $str;
}


function persyaratan_dir($str = null)

{

    $url = 'doc/persyaratan/';

    if (!$str) {
        return public_path() . $url;
    }

    return public_path() . $url . $str;
}

function footer_tte()
{
    return 'Dokumen ini telah ditandatangani secara elektronik yang diterbitkan oleh Balai Sertifikasi Elektronik (BSrE), BSSN';
}

function nama_kadis()
{
    return 'Ir.SUHARYO';
}

function pangkat_kadis()
{
    return 'Pembina Utama Muda';
}

function nip_kadis()
{
    return '196405021987031020';
}

function key_secret()
{
    return 'dashdsSDGASH7129371238!#%(*&*&';
}
function cek_file_publik($file, $ket)
{

    $url = 'https://dpmptsp.tanahlautkab.go.id/online/uploads/persyaratan/' . $file;

    if ($ket) {
        $url =  base_url('doc/persyaratan/' . $file);
    }

    return $url;
}

function path_online()
{
    return 'https://dpmptsp.tanahlautkab.go.id/online/uploads/persyaratan/';
}

function data_type($str)
{

    if ($str == 'date') {
        return 'tanggal';
    }

    if ($str == 'var_string') {
        return 'text';
    }

    return $str;
}


function data_type2($str)
{


    if ($str == 'var_string') {
        return 'varchar';
    }

    return $str;
}

function data_type_arr()
{
    $arr['varchar'] = 'text';
    $arr['date'] = 'tanggal';

    return $arr;
}

function ubah_key($str)
{
    $row['nama_kolom'] = $str->name;
    $row['tipe_data'] = data_type($str->type_name);

    $panjang = NULL;
    if ($str->type_name != 'date') {


        // kada tahu jua kenapa di bagi 3
        $panjang =  $str->length / 3;
    }
    $row['panjang'] = $panjang;

    return $row;
}

function nama_aplkasi()
{
    return 'APLIKASI PELAYANAN PERIZINAN TERPADU DPMPTSP KAB. TANAH LAUT';
}

function singkatan_aplikasi()
{
    return 'APPERINDU';
}

function replace_variable($var)
{
    $var = str_replace('_', ' ', $var); // Mengganti garis bawah dengan spasi
    $var = strtoupper($var); // Mengonversi huruf pertama setiap kata menjadi huruf besar

    return 'CTH: ' . $var;
}