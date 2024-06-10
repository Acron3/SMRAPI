<?php
use CodeIgniter\Router\RouteCollection;
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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->post('login', 'Login::index');
$routes->get('refresh_token', 'Login::refresh_token');
$routes->post('register', 'Register::index');
$routes->post('user', 'User::create');
$routes->get('user', 'User::index', ['filter' => 'auth']);
$routes->put('user/(:num)', 'User::update/$1', ['filter' => 'auth']);
$routes->get('tim/(:num)', 'User::tim/$1', ['filter' => 'auth']);
$routes->get('kecakapan', 'Kecakapan::index');
$routes->post('kecakapan', 'Kecakapan::create', ['filter' => 'auth']);
$routes->put('kecakapan/(:num)', 'Kecakapan::update/$1', ['filter' => 'auth']);
$routes->delete('kecakapan/(:num)', 'Kecakapan::delete/$1', ['filter' => 'auth']);
$routes->get('user/(:num)', 'User::show/$1', ['filter' => 'auth']);
$routes->post('user/register_kegiatan', 'User::registerKegiatan', ['filter' => 'auth']);
$routes->resource('register');
//$routes->resource('user');
$routes->resource('daftar_kegiatan', ['filter' => 'auth']);
$routes->resource('laporan_harian', ['filter' => 'auth']);
$routes->resource('daftar_tugas', ['filter' => 'auth']);
$routes->resource('target', ['filter' => 'auth']);
//$routes->get('target', 'Target::index', ['filter' => 'auth']);
$routes->resource('pemasukan', ['filter' => 'auth']);
$routes->resource('RAB', ['filter' => 'auth']);
$routes->get('rab_realisasi/(:num)', 'Daftar_Kegiatan::rab_realisasi/$1', ['filter' => 'auth']);
$routes->resource('pendaftaran_relawan', ['filter' => 'auth']);
$routes->resource('agenda', ['filter' => 'auth']);
$routes->resource('pengeluaran', ['filter' => 'auth']);

$routes->match(['options'], '(:any)', function() {
    return service('response')
        ->setStatusCode(200)
        ->setHeader('Access-Control-Allow-Origin', '*')
        ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
        ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
});
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
//  */
// if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
//     require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
// }