<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==== AUTHENTICATION & USER ACCOUNT ====
$routes->get('/', 'Auth::login'); // Route default ke halaman login
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login_post', 'Auth::login_post');
$routes->get('auth/signup', 'Auth::signup');
$routes->post('auth/signup_post', 'Auth::signup_post');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/akun', 'UserAccount::index');
$routes->get('/logout', 'UserAccount::logout');
$routes->get('/useraccount', 'UserAccount::index');
$routes->get('/useraccount/edit', 'UserAccount::edit');
$routes->post('/useraccount/update', 'UserAccount::update');

// ==== DASHBOARD ====
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'role:user']);
$routes->get('admindashboard', 'AdminDashboard::index', ['filter' => 'role:admin']);
$routes->get('admin/dashboard', 'AdminDashboard::index');

// ==== PERMINTAAN SERVICE ====
$routes->get('/permintaanservice', 'PermintaanService::index');
$routes->post('/permintaanservice/store', 'PermintaanService::store');
$routes->get('/permintaanservice/detail/(:num)', 'PermintaanService::detail/$1');
$routes->get('/detailservice', 'Service::detailservice');
$routes->get('service/payment-form/(:num)', 'Service::paymentForm/$1');

// ==== SERVICE SCHEDULE / JADWAL SERVICE ====
$routes->get('/manajemenjadwal', 'ManajemenJadwal::index');
$routes->post('/manajemenjadwal/update', 'ManajemenJadwal::update');
$routes->get('admin/editjadwal/(:num)', 'ManajemenJadwal::edit/$1');
$routes->post('admin/manajemenjadwal/update/(:num)', 'ManajemenJadwal::updateDetail/$1');
$routes->get('admin/tambahjadwal', 'ManajemenJadwal::formTambah');
$routes->post('manajemenjadwal/tambah', 'ManajemenJadwal::tambah');
$routes->post('admin/manajemenjadwal/delete/(:num)', 'ManajemenJadwal::delete/$1');
$routes->post('admin/hapusjadwal/(:num)', 'ManajemenJadwal::delete/$1');
$routes->get('/service-schedule', 'ServiceScheduleController::index');

$routes->get('jadwalservice/delete/(:num)', 'ServiceScheduleController::delete/$1');    // Hapus jadwal
$routes->get('service-schedule/(:num)', 'ServiceScheduleController::show/$1');
$routes->get('jadwalservice', 'ServiceScheduleController::index');
$routes->get('jadwalservice', 'Home::jadwalservice');

$routes->get('/service-schedule', 'ServiceScheduleController::index');
$routes->get('/service-schedule/create', 'ServiceScheduleController::create');
$routes->post('/service-schedule/store', 'ServiceScheduleController::store');
$routes->post('/service-schedule/delete/(:num)', 'ServiceScheduleController::delete/$1');

// ==== RIWAYAT PERAWATAN ====
$routes->get('riwayatperawatan', 'RiwayatPerawatan::index');

// ==== ADMIN - MANAGEMENT ====
$routes->get('admin/manajemenpengguna', 'ManajemenPengguna::index');
$routes->get('admin/manajemenpengguna/formtambah', 'ManajemenPengguna::formTambah');
$routes->post('admin/manajemenpengguna/tambah', 'ManajemenPengguna::tambah');
$routes->get('admin/manajemenpengguna/formedit/(:num)', 'ManajemenPengguna::formEdit/$1');
$routes->post('admin/manajemenpengguna/edit', 'ManajemenPengguna::edit');
$routes->get('admin/manajemenpengguna/hapus/(:num)', 'ManajemenPengguna::hapus/$1');
$routes->get('admin/manajemenjadwal', 'ManajemenJadwal::index');

$routes->get('manajemenjadwal/add', 'ManajemenJadwal::add');
$routes->post('manajemenjadwal/store', 'ManajemenJadwal::store'); 
$routes->get('manajemenjadwal/edit/(:num)', 'ManajemenJadwal::edit/$1');
$routes->post('manajemenjadwal/update/(:num)', 'ManajemenJadwal::update/$1'); 
$routes->get('manajemenjadwal/delete/(:num)', 'ManajemenJadwal::delete/$1'); 



$routes->get('/admin/datakendaraan', 'AdminDashboard::datakendaraan');


// ==== ADMIN - SUKU CADANG ====
$routes->get('/admin/sukucadang', 'SukuCadang::index');
$routes->post('/admin/sukucadang/tambah', 'SukuCadang::tambah');
$routes->get('/admin/sukucadang/getById/(:num)', 'SukuCadang::getById/$1'); 
$routes->post('/admin/sukucadang/edit', 'SukuCadang::edit');
$routes->post('admin/sukucadang/hapus/(:num)', 'SukuCadang::hapus/$1');



// ==== ADMIN - STATISTIK, LAPORAN, LOG ====

$routes->get('/admin/laporan', 'LaporanController::index');
// ==== LAPORAN ====
$routes->get('/admin/laporan', 'LaporanController::index');
$routes->get('/admin/laporan/filter', 'LaporanController::filter');
$routes->get('/admin/laporan/export-pdf', 'LaporanController::exportPdf');
$routes->get('/admin/laporan/export-excel', 'LaporanController::exportExcel');

// ==== PAYMENT ====
$routes->get('/payment', 'PaymentController::index');
$routes->post('/payment/process', 'PaymentController::process');
$routes->get('/payment/history', 'PaymentController::history');
$routes->get('payment/list', 'PaymentController::list');

$routes->get('service/payment-form/(:num)', 'Service::paymentForm/$1');
$routes->get('/payment/(:num)', 'Payment::index/$1');

$routes->get('payment/history/(:num)', 'PaymentController::history/$1');
$routes->get('payment/downloadPdf/(:num)', 'PaymentController::downloadPdf/$1');

// ==== RIWAYAT PERAWATAN ====
$routes->get('/riwayat-perawatan', 'RiwayatPerawatan::index');
