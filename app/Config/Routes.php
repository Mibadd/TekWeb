<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login'); // Route default ke halaman login
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login_post', 'Auth::login_post');
$routes->get('auth/signup', 'Auth::signup');
$routes->post('auth/signup_post', 'Auth::signup_post');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('jadwalservice', 'JadwalService::index');
$routes->get('permintaanservice', 'PermintaanService::index');
$routes->post('permintaanservice/create', 'PermintaanService::create');
$routes->get('riwayatperawatan', 'RiwayatPerawatan::index');
$routes->get('admin/dashboard', 'AdminDashboard::index');
$routes->get('/admin/manajemenpengguna', 'AdminDashboard::manajemenPengguna');
$routes->get('/admin/datakendaraan', 'AdminDashboard::datakendaraan');
$routes->get('/admin/sukucadang', 'AdminDashboard::sukucadang');
$routes->get('/admin/statistik', 'AdminDashboard::statistik');
$routes->get('/admin/laporan', 'AdminDashboard::laporan');
$routes->get('/admin/logaktivitas', 'AdminDashboard::logaktivitas');
