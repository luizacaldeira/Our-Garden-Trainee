<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');
$router->get('publicacoes', 'PaginaPostsController@index');
$router->get('post', 'PostIndividualController@index');

$router->get('usuarios', 'UsuariosController@index');
$router->post('usuarios/criar', 'UsuariosController@criar');
$router->post('usuarios/editar', 'UsuariosController@editar');
$router->post('usuarios/deletar', 'UsuariosController@deletar');

$router->get('login', 'LoginController@index');
$router->post('login', 'LoginController@loginVerification');

$router->get('dashboard', 'DashboardController@index');
$router->post('logout', 'DashboardController@logout');
$router->post('logoutSidebar', 'DashboardController@logoutSidebar');

// ROTAS DE PUBLICAÇÕES
$router->get('posts', 'PublicacoesController@index');
$router->post('posts/create', 'PublicacoesController@create');
$router->post('posts/edit', 'PublicacoesController@edit');
$router->post('posts/delete', 'PublicacoesController@delete');
