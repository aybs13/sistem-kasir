<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


//rute login
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');

// Rute manajemen user
$routes->get('/user', 'User::index');
$routes->get('/user/create', 'User::create');
$routes->post('/user/store', 'User::store');
$routes->get('/user/edit/(:num)', 'User::edit/$1');
$routes->post('/user/update/(:num)', 'User::update/$1');
$routes->get('/user/delete/(:num)', 'User::delete/$1');

//rute barang
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/create', 'Barang::create');
$routes->post('/barang/store', 'Barang::store');
$routes->get('/barang/edit/(:num)', 'Barang::edit/$1');
$routes->post('/barang/update/(:num)', 'Barang::update/$1');
$routes->get('/barang/delete/(:num)', 'Barang::delete/$1');

//rute transaksi
$routes->get('/transaksi', 'Transaksi::index');
$routes->post('/transaksi/cari', 'Transaksi::cari');
$routes->post('/transaksi/simpan', 'Transaksi::simpan');
$routes->get('/transaksi/nota/(:num)', 'Transaksi::nota/$1');

//rute laporam
$routes->get('/laporan', 'Laporan::index');
$routes->post('/laporan', 'Laporan::filter');
$routes->get('/laporan/laba-rugi', 'Laporan::labaRugi');


$routes->get('dashboard/statistik', 'Dashboard::statistik');

$routes->get('/stok-menipis', 'Barang::stokMenipis');
$routes->get('/barang/expired', 'Barang::expired');
$routes->post('/api/barcode', 'Api\BarangApi::cariBarcode');

$routes->get('/riwayat', 'Transaksi::riwayat');
$routes->get('/riwayat/detail/(:num)', 'Transaksi::riwayatDetail/$1');

//rute biaya operasional
$routes->get('biaya', 'BiayaOperasional::index');
$routes->get('biaya/create', 'BiayaOperasional::create');
$routes->post('biaya/store', 'BiayaOperasional::store');
$routes->get('biaya/edit/(:num)', 'BiayaOperasional::edit/$1');
$routes->put('biaya/update/(:num)', 'BiayaOperasional::update/$1');
$routes->post('biaya/delete/(:num)', 'BiayaOperasional::delete/$1');
