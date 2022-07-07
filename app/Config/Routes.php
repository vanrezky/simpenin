<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('pc-detected', 'Home::pcDetected');

$routes->group('simpan', [], function ($routes) {
    $routes->get('detail/(:num)', 'Home::detail/$1');
    $routes->get('transaksi-step1/(:num)', 'Home::transaksiStep1/$1');
    $routes->get('transaksi-step2/(:num)', 'Home::transaksiStep2/$1');
    $routes->post('transaksi-step2-save/(:num)', 'Home::transaksiStep2Save/$1');
    $routes->get('transaksi-step3/(:num)', 'Home::transaksiStep3/$1');
    $routes->post('transaksi-step3-save/(:num)', 'Home::transaksiStep3Save/$1');
    $routes->post('transaksi-save', 'Home::transaksiSave/$1');
    $routes->get('barang-detail/(:num)', 'Home::barangDetail/$1');
    $routes->post('barang-hapus/(:num)', 'Home::barangHapus/$1');
});


$routes->group('kirim', [], function ($routes) {
    $routes->get('/', 'Kirim::index');
    $routes->get('detail/(:num)', 'Kirim::detail/$1');
    $routes->get('kirim/(:num)', 'Kirim::kirim/$1');
    $routes->post('save', 'Kirim::save');
    $routes->get('pengiriman/(:num)', 'Kirim::pengiriman/$1');
    $routes->get('pengiriman-detail/(:num)', 'Kirim::pengirimanDetail/$1');
    $routes->get('lacak/(:num)', 'Kirim::lacak/$1');
});

$routes->group('akun', [], function ($routes) {
    $routes->match(['get', 'post'], '/', 'Home::akun');
    $routes->match(['get', 'post'], 'alamat', 'Home::akunAlamat');
    $routes->match(['get', 'post'], 'data', 'Home::akunData');
    $routes->post('penerima', 'Home::akunAlamatPenerima');
    $routes->post('alamat', 'Home::akunAlamat');
});
$routes->group('gudang', [], function ($routes) {
    $routes->get('/', 'Gudang::index');
    $routes->get('add', 'Gudang::data');
    $routes->get('edit/(:num)', 'Gudang::data/$1');
    $routes->post('save', 'Gudang::data');
});




$routes->match(['get', 'post'], 'login', 'Auth::index');
$routes->match(['get', 'post'], 'daftar', 'Auth::register');
$routes->get('lupa-password', 'Auth::lupaPassword');
$routes->get('logout', 'Auth::logout');

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
