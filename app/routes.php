<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');

$router->get('usuarios', 'UsuariosController@index');
$router->post('usuarios/criar', 'UsuariosController@criar');
$router->post('usuarios/editar', 'UsuariosController@editar');
$router->post('usuarios/deletar', 'UsuariosController@deletar');

$router->get('login', 'LoginController@index');
$router->post('login', 'LoginController@loginVerification');

$router->get('dashboard', 'DashboardController@index');