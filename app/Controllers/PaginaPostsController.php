<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PaginaPostsController
{
    public function index()
    {
        return view('site/paginaDePosts');
    }

    public function exibirPostIndividual($id)
    {
        $post = App::get('database')->selectPostWithUserById($id);

        $classificacoes = App::get('database')->selectPostsWithClassification($id);

        $post->classificacoes = $classificacoes;

        return view('site/postIndividual', compact('post'));
    }
}
