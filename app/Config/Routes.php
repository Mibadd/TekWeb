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
$routes->get('dashboard', 'Home::dashboard');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'role:user']);
$routes->get('admindashboard', 'AdminDashboard::index', ['filter' => 'role:admin']);
$routes->get('admin/dashboard', 'AdminDashboard::index');

// ==== PERMINTAAN SERVICE ====
$routes->get('/permintaanservice', 'PermintaanService::index');
$routes->post('/permintaanservice/store', 'PermintaanService::store');
$routes->post('permintaanservice/create', 'PermintaanService::create');

// ==== SERVICE SCHEDULE / JADWAL SERVICE ====
$routes->get('jadwalservice', 'ServiceScheduleController::index');                      // Melihat daftar jadwal service
$routes->get('jadwalservice/create', 'ServiceScheduleController::create');              // Form tambah jadwal service
$routes->post('jadwalservice/store', 'ServiceScheduleController::store');               // Proses simpan jadwal baru
$routes->get('jadwalservice/edit/(:num)', 'ServiceScheduleController::edit/$1');        // Form edit jadwal
$routes->post('jadwalservice/update/(:num)', 'ServiceScheduleController::update/$1');   // Proses update jadwal
$routes->get('service-schedule/(:num)', 'ServiceScheduleController::show/$1');


$routes->get('jadwalservice/delete/(:num)', 'ServiceScheduleController::delete/$1');    // Hapus jadwal
$routes->get('service-schedule/(:num)', 'ServiceScheduleController::show/$1');


$routes->get('/service-schedule', 'ServiceScheduleController::index');
$routes->get('/service-schedule/create', 'ServiceScheduleController::create');
$routes->post('/service-schedule/store', 'ServiceScheduleController::store');
$routes->post('/service-schedule/delete/(:num)', 'ServiceScheduleController::delete/$1');

// ==== RIWAYAT PERAWATAN ====
$routes->get('riwayatperawatan', 'RiwayatPerawatan::index');

// ==== ADMIN - MANAGEMENT ====
$routes->get('/admin/manajemenpengguna', 'AdminDashboard::manajemenPengguna');
$routes->post('admin/manajemenpengguna/edit', 'ManajemenPengguna::edit');
$routes->get('manajemenjadwal/edit/(:num)', 'ManajemenJadwal::edit/$1');

$routes->get('manajemenjadwal', 'ManajemenJadwal::index');
$routes->get('manajemenjadwal/add', 'ManajemenJadwal::add');
$routes->post('manajemenjadwal/store', 'ManajemenJadwal::store'); // jika ada fungsi simpan data
$routes->get('manajemenjadwal/edit/(:num)', 'ManajemenJadwal::edit/$1');
$routes->post('manajemenjadwal/update/(:num)', 'ManajemenJadwal::update/$1'); // jika ada update data
$routes->get('manajemenjadwal/delete/(:num)', 'ManajemenJadwal::delete/$1'); // jika ada delete



$routes->get('/admin/datakendaraan', 'AdminDashboard::datakendaraan');
$routes->get('/admin/manajemenjadwal', 'ManajemenJadwal::index');
$routes->get('admin/manajemenjadwal', 'Admin\ManajemenJadwal::index');

// ==== ADMIN - SUKU CADANG ====
$routes->get('/admin/sukucadang', 'SukuCadang::index');
$routes->post('/admin/sukucadang/tambah', 'SukuCadang::tambah');
$routes->get('/admin/sukucadang/getById/(:num)', 'SukuCadang::getById/$1'); 
$routes->post('/admin/sukucadang/edit', 'SukuCadang::edit');
$routes->get('/admin/sukucadang/hapus/(:num)', 'SukuCadang::hapus/$1');

// ==== ADMIN - STATISTIK, LAPORAN, LOG ====
$routes->get('/admin/laporan', 'AdminDashboard::laporan');

// ==== LAPORAN ====
$routes->get('/admin/laporan', 'LaporanController::index');
$routes->get('laporan', 'LaporanController::index');
$routes->get('laporan/filter', 'LaporanController::filter');
$routes->get('laporan/export-pdf', 'LaporanController::exportPdf');
$routes->get('laporan/export-excel', 'LaporanController::exportExcel');

// ==== PAYMENT ====
$routes->get('/payment', 'PaymentController::index');
$routes->post('/payment/process', 'PaymentController::process');
$routes->get('/payment/history', 'PaymentController::history');

