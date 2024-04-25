<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 // prefiero manejar las rutas manualmente ya que 
 // al momento de llamar no puedo invocar cpelicula, eso le dice al usuario que estoy llamando un controlador y es mvc

 //$routes->get('pelicula', 'Home::index');

$routes->get('pelicula',             'CPelicula::index');
$routes->get('pelicula/show/(:any)', 'CPelicula::show/$1');
$routes->get('pelicula/new',         'CPelicula::new');
$routes->get('pelicula/edit/(:any)', 'CPelicula::edit/$1');

$routes->post('pelicula/create',        'CPelicula::create');
$routes->post('pelicula/update/(:any)', 'CPelicula::update/$1');
$routes->post('pelicula/delete/(:any)', 'CPelicula::delete/$1');

//$routes ->presenter('cpelicula');
/*
C:\laragon\www\peliculas
λ php spark routes

CodeIgniter v4.5.1 Command Line Tool - Server Time: 2024-04-25 02:40:44 UTC+00:00

+--------+-----------------------+------+---------------------------------------+----------------+---------------+
| Method | Route                 | Name | Handler                               | Before Filters | After Filters |
+--------+-----------------------+------+---------------------------------------+----------------+---------------+
| GET    | cpelicula             | »    | \App\Controllers\Cpelicula::index     |                |               |  [ LISTO ]
| GET    | cpelicula/show/(.*)   | »    | \App\Controllers\Cpelicula::show/$1   |                |               |  [ LISTO ]
| GET    | cpelicula/new         | »    | \App\Controllers\Cpelicula::new       |                |               |  [ LISTO ]
| GET    | cpelicula/edit/(.*)   | »    | \App\Controllers\Cpelicula::edit/$1   |                |               |
| GET    | cpelicula/remove/(.*) | »    | \App\Controllers\Cpelicula::remove/$1 |                |               |
| GET    | cpelicula/(.*)        | »    | \App\Controllers\Cpelicula::show/$1   |                |               |  
| POST   | cpelicula/create      | »    | \App\Controllers\Cpelicula::create    |                |               |  [ LISTO ]
| POST   | cpelicula/update/(.*) | »    | \App\Controllers\Cpelicula::update/$1 |                |               |
| POST   | cpelicula/delete/(.*) | »    | \App\Controllers\Cpelicula::delete/$1 |                |               |
| POST   | cpelicula             | »    | \App\Controllers\Cpelicula::create    |                |               |
+--------+-----------------------+------+---------------------------------------+----------------+---------------+

*/


