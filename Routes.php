<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/tickets', 'TicketController::index');
$routes->get('/tickets/archive', 'TicketController::archive');
$routes->post('/tickets/delete/(:num)', 'TicketController::delete/$1');
$routes->post('/tickets/restore/(:num)', 'TicketController::restore/$1');
$routes->post('/tickets/force-delete/(:num)', 'TicketController::forceDelete/$1');