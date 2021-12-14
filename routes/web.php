<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//$router->get('/api/usuario', 'UsuarioController@index');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    // Protected routes for token API
    $router->group(['middleware' => 'auth'], function () use ($router) {
        // rutas de usuario
        $router->get('usuario',         ['uses' => 'UsuarioController@index']);
        $router->get('usuario/{id}',    ['uses' => 'UsuarioController@show']);
        $router->post('usuario',        ['uses' => 'UsuarioController@store']);
        $router->delete('usuario/{id}', ['uses' => 'UsuarioController@delete']);
        $router->put('usuario/{id}',    ['uses' => 'UsuarioController@update']);

        // Rutas de <Controller/Afiliacion>
        $router->group(['namespace' => 'Afiliacion'], function() use ($router)
        {
            $router->get('afiliado',         ['uses' => 'AfiliadoController@index']);
            $router->get('afiliado/{id}',    ['uses' => 'AfiliadoController@show'] );
            $router->post('afiliado',        ['uses' => 'AfiliadoController@store']);
            $router->delete('afiliado/{id}', ['uses' => 'AfiliadoController@delete']);
            $router->put('afiliado/{id}',    ['uses' => 'AfiliadoController@update']);
            $router->get('buscar_afiliado',  ['uses' => 'ConsultasAfiliadoController@buscar_afiliado']);

        });

        // Rutas de listados para tablas de tipos y estados
        $router->group(['namespace' => 'Commons'], function () use ($router) {
            $router->get('tipoDocumento_all', ['uses' => 'ListasController@getTipoDocumento']);
        });
    });
});

// Rutas para usuarios

