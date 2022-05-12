<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Produk
$routes->get('/', 'Produk::index');
$routes->get('/produk/create', 'Produk::create');
$routes->post('/produk/save', 'Produk::save');
$routes->delete('/produk/{id}', 'Produk::delete/{id}');
$routes->get('/produk/edit/{id}', 'Produk::edit/{id}');

// Cabang
$routes->get('/cabang', 'Cabang::index');
$routes->get('/cabang/create', 'Cabang::create');
$routes->post('/cabang/save', 'Cabang::save');
$routes->delete('/cabang/{id}', 'Cabang::delete/{id}');
$routes->get('/cabang/edit/{id}', 'Cabang::edit/{id}');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
