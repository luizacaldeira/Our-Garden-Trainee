<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');

// ROTAS DE PUBLICAÇÕES
$router->get('posts', 'PublicacoesController@index');
$router->post('posts/create', 'PublicacoesController@create');
$router->post('posts/edit', 'PublicacoesController@edit');
$router->post('posts/delete', 'PublicacoesController@delete');