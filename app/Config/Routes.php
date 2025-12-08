<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication Routes
$routes->get('login', 'AuthController::loginForm');
$routes->post('auth/login', 'AuthController::login');
$routes->get('register', 'AuthController::registerForm');
$routes->post('auth/register', 'AuthController::register');
$routes->get('auth/logout', 'AuthController::logout');

// Client Dashboard and Profile Routes
$routes->group('client', static function ($routes) {
    $routes->get('dashboard', 'ClientController::dashboard', ['filter' => 'auth']);
    $routes->get('edit-profile', 'ClientController::editForm', ['filter' => 'auth']);
    $routes->post('update-profile', 'ClientController::updateProfile', ['filter' => 'auth']);
    $routes->get('reservations', 'ClientController::viewReservations', ['filter' => 'auth']);
});

// Chambre Routes
$routes->get('chambres', 'ChambreController::index');
$routes->get('chambres/search', 'ChambreController::search');
$routes->get('chambre/detail/(:num)', 'ChambreController::detail/$1');
$routes->group('chambre', ['filter' => 'admin'], static function ($routes) {
    $routes->get('create', 'ChambreController::createForm');
    $routes->post('create', 'ChambreController::create');
    $routes->get('edit/(:num)', 'ChambreController::editForm/$1');
    $routes->post('update/(:num)', 'ChambreController::update/$1');
    $routes->get('delete/(:num)', 'ChambreController::delete/$1');
});

// Reservation Routes
$routes->group('reservation', static function ($routes) {
    $routes->get('booking/(:num)', 'ReservationController::bookingForm/$1', ['filter' => 'auth']);
    $routes->post('create', 'ReservationController::create', ['filter' => 'auth']);
    $routes->get('detail/(:num)', 'ReservationController::detail/$1', ['filter' => 'auth']);
    $routes->get('cancel/(:num)', 'ReservationController::cancel/$1', ['filter' => 'auth']);
    $routes->get('confirm/(:num)', 'ReservationController::confirm/$1', ['filter' => 'admin']);
});

// Admin Routes
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users', 'AdminController::users');
    $routes->get('clients', 'AdminController::clients');
    $routes->get('reservations', 'AdminController::reservations');
    $routes->post('update-reservation-status/(:num)', 'AdminController::updateReservationStatus/$1');
    $routes->get('delete-user/(:num)', 'AdminController::deleteUser/$1');
});

// Test Routes
$routes->get('test/database', 'TestController::testDatabase');
$routes->get('test/tables', 'TestController::checkTables');

// Alias for dashboard
$routes->get('dashboard', static function() {
    $session = session();
    if ($session->get('role') === 'admin') {
        return redirect()->to(base_url('admin/dashboard'));
    }
    return redirect()->to(base_url('client/dashboard'));
}, ['filter' => 'auth']);
