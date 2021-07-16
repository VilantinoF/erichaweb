<?php

namespace Config;
// use App\Models\FilesModel;

// $filesModel = new FilesModel();

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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->set404Override(function () {
	return view('errors/404error.php');
});
// routes adbis
$routes->get('adbis/(:segment)/(:segment)/(:segment)', 'Adbis::index');
$routes->get('adbis/(:segment)/(:segment)', 'Adbis::index');
$routes->get('adbis/(:segment)', 'Adbis::index');
$routes->get('Adbis', 'Pages::index');
$routes->get('Adbis/', 'Pages::index');

// routes akuntansi
$routes->get('akuntansi/(:segment)/(:segment)/(:segment)', 'Akuntansi::index');
$routes->get('akuntansi/(:segment)/(:segment)', 'Akuntansi::index');
$routes->get('akuntansi/(:segment)', 'Akuntansi::index');
$routes->get('Akuntansi', 'Pages::index');
$routes->get('Akuntansi/', 'Pages::index');

// route elektro
$routes->get('elektro/(:segment)/(:segment)/(:segment)', 'Elektro::index');
$routes->get('elektro/(:segment)/(:segment)', 'Elektro::index');
$routes->get('elektro/(:segment)', 'Elektro::index');
$routes->get('Elektro', 'Pages::index');
$routes->get('Elektro/', 'Pages::index');

// route mesin
$routes->get('mesin/(:segment)/(:segment)/(:segment)', 'Mesin::index');
$routes->get('mesin/(:segment)/(:segment)', 'Mesin::index');
$routes->get('mesin/(:segment)', 'Mesin::index');
$routes->get('Mesin', 'Pages::index');
$routes->get('Mesin/', 'Pages::index');

// route sipil
$routes->get('sipil/(:segment)/(:segment)/(:segment)', 'Sipil::index');
$routes->get('sipil/(:segment)/(:segment)', 'Sipil::index');
$routes->get('sipil/(:segment)', 'Sipil::index');
$routes->get('Sipil', 'Pages::index');
$routes->get('Sipil/', 'Pages::index');

$routes->get('/', 'Auth::index');
// $routes->get('subSubFolder', 'Pages::manageSubSubFolder');
// $routes->get('/', 'Home::index');

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
