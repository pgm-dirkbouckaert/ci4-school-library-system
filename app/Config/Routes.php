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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Public Routes
 * --------------------------------------------------------------------
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Home::admin');

// Public Book routes
// ------------------
$routes->get('/books', 'Book::index');
$routes->get('/books/index', 'Book::index');
$routes->post('/books', 'Book::index');
$routes->get('/books/detail/(:num)', 'Book::showDetail/$1');

// Public Collection routes
// ------------------------
$routes->get('/collections', 'Collection::index');
$routes->get('/collections/index', 'Collection::index');
$routes->post('/collections', 'Collection::index');
$routes->get('/collections/detail/(:num)', 'Collection::showDetail/$1');

/*
 * --------------------------------------------------------------------
 * Routes for logged in users
 * --------------------------------------------------------------------
 */
$routes->group("/", ["filter" => "login"], function ($routes) {

  // Private Book routes
  // -------------------
  $routes->get('/books/add', 'Book::showAdd');
  $routes->post('/books/add', 'Book::add');
  $routes->get('/books/edit/(:num)', 'Book::showEdit/$1');
  $routes->post('/books/edit/(:num)', 'Book::edit/$1');
  $routes->get('/books/delete/(:num)', 'Book::showDelete/$1');
  $routes->post('/books/delete/(:num)', 'Book::delete/$1');
  $routes->get('/books/add-to-collections/(:num)', 'Book::showAddToCollections/$1');
  $routes->post('/books/add-to-collections/(:num)', 'Book::addToCollections/$1');

  // Private LanguageCode routes
  // -------------------------
  $routes->get('/language-codes', 'LanguageCode::index');
  $routes->post('/language-codes', 'LanguageCode::index');

  // Private Collection routes
  // -------------------------
  $routes->get('/collections/add', 'Collection::showAdd');
  $routes->post('/collections/add', 'Collection::add');
  $routes->get('/collections/add-books/(:num)', 'Collection::showAddBooks/$1');
  $routes->post('/collections/add-books/(:num)', 'Collection::addBooks/$1');
  $routes->get('/collections/edit/(:num)', 'Collection::showEdit/$1');
  $routes->post('/collections/edit/(:num)', 'Collection::edit/$1');
  $routes->post('/collections/delete/(:num)', 'Collection::delete/$1');

  // Private Member routes
  // --------------------
  $routes->get('/members', 'Member::index');
  $routes->get('/members/index', 'Member::index');
  $routes->post('/members', 'Member::index');
  $routes->get('/members/detail/(:num)', 'Member::showDetail/$1');
  $routes->get('/members/add', 'Member::showAdd');
  $routes->post('/members/add', 'Member::add');
  $routes->get('/members/edit/(:num)', 'Member::showEdit/$1');
  $routes->post('/members/edit/(:num)', 'Member::edit/$1');
  $routes->get('/members/manage-checkouts/(:num)', 'Member::showManageCheckouts/$1');
  $routes->post('/members/manage-checkouts/(:num)', 'Member::manageCheckouts/$1');
  $routes->post('/members/delete/(:num)', 'Member::delete/$1');

  // Private Checkout routes (loans)
  // -------------------------------
  $routes->get('/checkouts', 'Checkout::index');
  $routes->get('/checkouts/index/', 'Checkout::index');
  $routes->post('/checkouts', 'Checkout::index');
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
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
