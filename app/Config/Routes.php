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

    //$routes->resource('pelicula','Api\APelicula::index');

    $routes->resource('Pelicula');
    $routes->get('api/pelicula', 'Api\APelicula::index');   
    //http://peliculas.test/api/pelicula    o    http://peliculas.test/api/pelicula?format=json
    $routes->get('api/pelicula/(:any)',     'Api\APelicula::show/$1');    
    $routes->post('api/pelicula',           'Api\APelicula::create');    
    $routes->put( 'api/pelicula/(:any)',    'Api\APelicula::update/$1');
    $routes->patch('api/pelicula/(:any)',   'Api\APelicula::update/$1');
    $routes->delete('api/pelicula/(:any)',  'Api\APelicula::delete/$1');

    $routes->resource('Categoria');
    $routes->get(   'api/categoria', 'Api\ACategoria::index');   
      //http://peliculas.test/api/categoria    o    http://peliculas.test/api/categoria?format=json
    $routes->get(   'api/categoria/(:any)',   'Api\ACategoria::show/$1');    
    $routes->post(  'api/categoria',         'Api\ACategoria::create');    
    $routes->put(   'api/categoria/(:any)',  'Api\ACategoria::update/$1');
    $routes->patch( 'api/categoria/(:any)',  'Api\ACategoria::update/$1');
    $routes->delete('api/categoria/(:any)',  'Api\ACategoria::delete/$1');
    


    
/*
    // agrupado para Api
    $routes->group('api',['namespace' => 'App\Controllers\Api'],function($routes){
      $routes->resource('pelicula');
   });
*/

  /*  esta es otra manera de crear las rutas
 $routes->group('dashboard',function($routes){
    $routes ->presenter('pelicula', ['controller'=>'Dasbboard\Pelicula'                    ]);
    $routes ->presenter('categoria',['controller'=>'Dasbboard\Categoria','except'=>['show']]);
    $routes ->get      ('usuario/crear', 'App\Controller\Web::crear_usuario');
 });
*/

/*
CodeIgniter v4.5.1 Command Line Tool - Server Time: 2024-05-03 22:11:55 UTC+00:00

+--------+-------------------------------------+-----------------------+--------------------------------------------------+-----------------+---------------+ 
| Method | Route                               | Name                  | Handler                                          | Before Filters  | After Filters 
| +--------+-------------------------------------+-----------------------+--------------------------------------------------+-----------------+---------------+
 | GET    | dashboard/pelicula                  | »                     | \App\Controllers\Dashboard\CPelicula::index      | DashboardFilter |               | 
 | GET    | dashboard/pelicula/show/(.*)        | »                     | \App\Controllers\Dashboard\CPelicula::show/$1    | DashboardFilter |               | 
 | GET    | dashboard/pelicula/new              | »                     | \App\Controllers\Dashboard\CPelicula::new        | DashboardFilter |               | 
 | GET    | dashboard/pelicula/edit/(.*)        | »                     | \App\Controllers\Dashboard\CPelicula::edit/$1    | DashboardFilter |               | 
 | GET    | dashboard/categoria                 | »                     | \App\Controllers\Dashboard\CCategoria::index     | DashboardFilter |               | 
 | GET    | dashboard/categoria/show/(.*)       | »                     | \App\Controllers\Dashboard\CCategoria::show/$1   | DashboardFilter |               | 
 | GET    | dashboard/categoria/new             | »                     | \App\Controllers\Dashboard\CCategoria::new       | DashboardFilter |               | 
 | GET    | dashboard/categoria/edit/(.*)       | »                     | \App\Controllers\Dashboard\CCategoria::edit/$1   | DashboardFilter |               | 
 | GET    | dashboard/usuario/crear             | »                     | \App\Controllers\Web\CUsuario::crear_usuario     | DashboardFilter |               | 
 | GET    | dashboard/usuario/probar_contrasena | »                     | \App\Controllers\Web\CUsuario::probar_contrasena | DashboardFilter |               | 
 | GET    | login                               | usuario.login         | \App\Controllers\Web\CUsuario::login             |                 |               | 
 | GET    | logout                              | usuario.logout        | \App\Controllers\Web\CUsuario::logout            |                 |               | 
 | GET    | register                            | usuario.register      | \App\Controllers\Web\CUsuario::register          |                 |               | 
 
 | POST   | dashboard/pelicula/create           | »                     | \App\Controllers\Dashboard\CPelicula::create     | DashboardFilter |               | 
 | POST   | dashboard/pelicula/update/(.*)      | »                     | \App\Controllers\Dashboard\CPelicula::update/$1  | DashboardFilter |               | 
 | POST   | dashboard/pelicula/delete/(.*)      | »                     | \App\Controllers\Dashboard\CPelicula::delete/$1  | DashboardFilter |               | 
 | POST   | dashboard/categoria/create          | »                     | \App\Controllers\Dashboard\CCategoria::create    | DashboardFilter |               | 
 | POST   | dashboard/categoria/update/(.*)     | »                     | \App\Controllers\Dashboard\CCategoria::update/$1 | DashboardFilter |               | 
 | POST   | dashboard/categoria/delete/(.*)     | »                     | \App\Controllers\Dashboard\CCategoria::delete/$1 | DashboardFilter |               | 
 | POST   | login_post                          | usuario.login_post    | \App\Controllers\Web\CUsuario::login_post        |                 |               | 
 | POST   | register_post                       | usuario.register_post | \App\Controllers\Web\CUsuario::register_post     |                 |               | 
 

 
 | GET    | api/pelicula                        | »                     | \App\Controllers\Api\Pelicula::index             |                 |               | 
 | GET    | api/pelicula/new                    | »                     | \App\Controllers\Api\Pelicula::new               |                 |               | 
 | GET    | api/pelicula/(.*)/edit              | »                     | \App\Controllers\Api\Pelicula::edit/$1           |                 |               | 
 | GET    | api/pelicula/(.*)                   | »                     | \App\Controllers\Api\Pelicula::show/$1           |                 |               | 
 
 | POST   | api/pelicula                        | »                     | \App\Controllers\Api\Pelicula::create            |                 |               | 
 | PATCH  | api/pelicula/(.*)                   | »                     | \App\Controllers\Api\Pelicula::update/$1         |                 |               | 
 | PUT    | api/pelicula/(.*)                   | »                     | \App\Controllers\Api\Pelicula::update/$1         |                 |               | 
 | DELETE | api/pelicula/(.*)                   | »                     | \App\Controllers\Api\Pelicula::delete/$1         |                 |               | 
 +--------+-------------------------------------+-----------------------+--------------------------------------------------+-----------------+---------------+
*/
