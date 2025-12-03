<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');

// ROTAS DE USUÁRIOS
$router->get('usuarios', 'UsuariosController@index');
$router->post('usuarios/criar', 'UsuariosController@criar');
$router->post('usuarios/editar', 'UsuariosController@editar');
$router->post('usuarios/deletar', 'UsuariosController@deletar');
$router->get('usuarios/buscaUsuarios', 'UsuariosController@buscaUsuarios');

// ROTAS DE PUBLICAÇÕES
$router->get('posts', 'PublicacoesController@index');
$router->post('posts/create', 'PublicacoesController@create');
$router->post('posts/edit', 'PublicacoesController@edit');
$router->post('posts/delete', 'PublicacoesController@delete');
$router->get('posts/buscaPublicacoes', 'PublicacoesController@buscaPublicacoes');

// ROTAS DE LOGIN
$router->get('login', 'LoginController@index');
$router->post('login', 'LoginController@loginVerification');
$router->post('logout', 'LoginController@logout');
$router->post('logoutSidebar', 'LoginController@logoutSidebar');
$router->post('login/register', 'LoginController@register');
$router->get('login/enviaEmail', 'LoginController@enviaEmail');

// ROTAS DA DASHBOARD
$router->get('dashboard', 'DashboardController@index');

// ROTAS DA PÁGINA DE POSTS
$router->get('publicacoes', 'PaginaPostsController@index');
$router->get('publicacoes/{id}', 'PaginaPostsController@exibirPostIndividual');

