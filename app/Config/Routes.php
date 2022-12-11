<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes->get('/', 'Home::index');

$routes->group('auth', function ($routes) {
    $routes->get('/', 'Auth::index');
    
$routes->post('prosesregis', 'Auth::prosesregis');

});

$routes->get('logout', 'Auth::logout');

$routes->get('login', 'Auth::index');
$routes->get('register', 'Auth::register');

$routes->post('ceklogin', 'Auth::ceklogin');

$routes->get('table', 'Home::table');
// $routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'ceklogin']);

$routes->group('form', ['filter' => 'ceklogin'], function ($routes) {
    $routes->get('createsekolah', 'Form::createsekolah');
    $routes->get('datasekolah', 'Form::datasekolah');
    $routes->get('update/(:segment)', 'Form::update/$1');
    $routes->get('hapus/(:num)', 'Form::hapus/$1');
});

$routes->get('/(:segment)', 'Home::detail/$1');


if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
