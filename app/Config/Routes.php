<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 // prefiero manejar las rutas manualmente ya que 
 // al momento de llamar no puedo invocar cpelicula, eso le dice al usuario que estoy llamando un controlador y es mvc

 //$routes->get('pelicula', 'Home::index');



   // http://peliculas.test/dashboard/pelicula
    $routes->get('dashboard/pelicula',             'Dashboard\CPelicula::index');
    $routes->get('dashboard/pelicula/show/(:any)', 'Dashboard\CPelicula::show/$1');
    $routes->get('dashboard/pelicula/new',         'Dashboard\CPelicula::new');
    $routes->get('dashboard/pelicula/edit/(:any)', 'Dashboard\CPelicula::edit/$1');

    $routes->post('dashboard/pelicula/create',        'Dashboard\CPelicula::create');
    $routes->post('dashboard/pelicula/update/(:any)', 'Dashboard\CPelicula::update/$1');
    $routes->post('dashboard/pelicula/delete/(:any)', 'Dashboard\CPelicula::delete/$1');


    // http://peliculas.test/dashboard/categoria
    $routes->get('dashboard/categoria',             'Dashboard\CCategoria::index');
    $routes->get('dashboard/categoria/show/(:any)', 'Dashboard\CCategoria::show/$1');
    $routes->get('dashboard/categoria/new',         'Dashboard\CCategoria::new');
    $routes->get('dashboard/categoria/edit/(:any)', 'Dashboard\CCategoria::edit/$1');

    $routes->post('dashboard/categoria/create',        'Dashboard\CCategoria::create');
    $routes->post('dashboard/categoria/update/(:any)', 'Dashboard\CCategoria::update/$1');
    $routes->post('dashboard/categoria/delete/(:any)', 'Dashboard\CCategoria::delete/$1');

    //$routes ->get('usuario/crear', 'App\Controller\Web::crear_usuario');
    $routes ->get('dashboard/usuario/crear', 'Web\CUsuario::crear_usuario');
    $routes ->get('dashboard/usuario/probar_contrasena', 'Web\CUsuario::probar_contrasena');

    $routes ->get( 'login',      'Web\CUsuario::login',     ['as'=>'usuario.login']);
    $routes ->post('login_post', 'Web\CUsuario::login_post',['as'=>'usuario.login_post']);
    $routes ->get( 'logout',     'Web\CUsuario::logout',    ['as'=>'usuario.logout']);
    
    $routes ->get( 'register',      'Web\CUsuario::register',     ['as'=>'usuario.register']);
    $routes ->post('register_post', 'Web\CUsuario::register_post',['as'=>'usuario.register_post']);

  /*  esta es otra manera de crear las rutas
 $routes->group('dashboard',function($routes){
    $routes ->presenter('pelicula', ['controller'=>'Dasbboard\Pelicula'                    ]);
    $routes ->presenter('categoria',['controller'=>'Dasbboard\Categoria','except'=>['show']]);
    $routes ->get      ('usuario/crear', 'App\Controller\Web::crear_usuario');
 });
*/

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


