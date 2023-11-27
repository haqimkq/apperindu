<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('dashboard', 'Master\Dashboard::index');

$routes->get('izin', 'Master\Izin::index');
$routes->get('permohonan', 'Master\Permohonan::index');
$routes->get('persyaratan', 'Master\Persyaratan::index');
$routes->get('persyaratan_permohonan', 'Master\Persyaratan_permohonan::index');
$routes->get('kecamatan', 'Master\Kecamatan::index');
$routes->get('kelurahan', 'Master\Kelurahan::index');
$routes->get('blok_sistem', 'Master\Blok_sistem::index');
$routes->get('blok_sistem_tugas', 'Master\Blok_sistem_tugas::index');
$routes->get('kendali_alur', 'Master\Kendali_alur::index');

$routes->get('pengguna', 'Master\Pengguna::index');
$routes->get('pengguna/form_page', 'Master\Pengguna::form_page');
$routes->get('pengguna/form_page/(:any)', 'Master\Pengguna::form_page/$1');

$routes->get('pengguna/logout', 'Master\Pengguna::logout');


$routes->get('pemohon/', 'Pemohon::index');
$routes->get('pemohon/form_page', 'Pemohon::form_page');

$routes->get('pendaftaran/', 'Pendaftaran::index');
$routes->get('pendaftaran/form_page', 'Pendaftaran::form_page');


$routes->get('kendali_berkas/view', 'Kendali_berkas::view');
$routes->get('kendali_berkas/form_page', 'Kendali_berkas::form_page');

$routes->get('tte/view', 'Tte::view');
$routes->get('tte/form_page', 'Tte::form_page');

$routes->get('login', 'Login::index');


$routes->get('dev', 'Master\Dev::index');
$routes->get('dev/pengguna_new', 'Master\Dev::pengguna_new');


$routes->get('tte_rekomendasi', 'Master\Tte_rekomendasi::index');


$routes->get('template_sk', 'Master\Template_sk::index');
$routes->get('template_sk/form_page', 'Master\Template_sk::form_page');
$routes->get('template_sk/form_page/(:any)', 'Master\Template_sk::form_page/$1');
$routes->get('template_sk/testing/(:any)', 'Master\Template_sk::testing/$1');

$routes->get('template_rekomendasi', 'Master\Template_rekomendasi::index');
$routes->get('template_rekomendasi/form_page', 'Master\Template_rekomendasi::form_page');
$routes->get('template_rekomendasi/form_page/(:any)', 'Master\Template_rekomendasi::form_page/$1');
$routes->get('template_rekomendasi/testing/(:any)', 'Master\Template_rekomendasi::testing/$1');


$routes->get('variabel_sk', 'Master\Variabel_sk::index');
$routes->get('variabel_sk/form_page', 'Master\Variabel_sk::form_page');
$routes->get('variabel_sk/update/(:any)', 'Master\Variabel_sk::update/$1');




$routes->get('verify/verify_by_qr', 'Verify::verify_by_qr');
$routes->get('pengaturan/form_page', 'Pengaturan::form_page');


// api
$routes->post('login_jwt', 'Api\LoginJwt::index');
$routes->post('login_api', 'Api\Login::index', ['filter' => 'auth_api']);
$routes->post('pendaftaran_by_nomor', 'Api\Permohonan::index', ['filter' => 'auth_api']);

$routes->post('get_token', 'Login::get_token');
$routes->get('perizinan/daftar_izin', 'Api\Perizinan::daftar_izin', ['filter' => 'auth_api']);
$routes->get('perizinan/daftar_kecamatan', 'Api\Perizinan::daftar_kecamatan', ['filter' => 'auth_api']);
$routes->post('perizinan/daftar_permohonan', 'Api\Perizinan::daftar_permohonan', ['filter' => 'auth_api']);
$routes->post('perizinan/daftar_persyaratan', 'Api\Perizinan::daftar_persyaratan', ['filter' => 'auth_api']);
$routes->post('perizinan/daftar_kelurahan', 'Api\Perizinan::daftar_kelurahan', ['filter' => 'auth_api']);

$routes->post('permohonan/cek_pernah_daftar', 'Api\Permohonan::pernah_daftar', ['filter' => 'auth_api']);
$routes->post('permohonan/daftar_akun', 'Api\Permohonan::daftar_akun', ['filter' => 'auth_api']);
$routes->post('permohonan/login', 'Api\Permohonan::login', ['filter' => 'auth_api']);
$routes->post('permohonan/riwayat_permohonan', 'Api\Permohonan::riwayat_permohonan', ['filter' => 'auth_api']);
$routes->post('permohonan/get_persyaratan', 'Api\Permohonan::get_persyaratan', ['filter' => 'auth_api']);

$routes->post('permohonan/get_by_id_pemohon', 'Api\Permohonan::get_by_id_pemohon', ['filter' => 'auth_api']);
$routes->post('permohonan/get_by_id_pendaftaran', 'Api\Permohonan::get_by_id_pendaftaran', ['filter' => 'auth_api']);
$routes->post('permohonan/pengajuan', 'Pendaftaran::form', ['filter' => 'auth_api']);
$routes->post('permohonan/pengajuan_update', 'Pendaftaran::form_update_api', ['filter' => 'auth_api']);
$routes->post('permohonan/riwayat', 'Pemohon::arsip_api', ['filter' => 'auth_api']);
$routes->post('permohonan/get_pemohon', 'Api\Permohonan::get_pemohon', ['filter' => 'auth_api']);
$routes->post('permohonan/update_pemohon', 'Api\Permohonan::update_pemohon', ['filter' => 'auth_api']);
$routes->post('permohonan/kirim_otp', 'Api\Permohonan::kirim_otp', ['filter' => 'auth_api']);
$routes->post('permohonan/verifikasi_otp', 'Api\Permohonan::verifikasi_otp', ['filter' => 'auth_api']);
$routes->post('permohonan/ganti_password', 'Api\Permohonan::ganti_password', ['filter' => 'auth_api']);
$routes->get('permohonan/dokumen/(:any)', 'Tte::after_tte/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}