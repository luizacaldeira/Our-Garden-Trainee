<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{

    public function index()
    {
        $posts = App::get('database')->selectAll('publicacoes');
        return view('admin/listaPosts' ,compact('posts'));
    }
}