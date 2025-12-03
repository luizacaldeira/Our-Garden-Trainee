<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PaginaPostsController
{
    public function index()
    {
        $posts = App::get('database')->selectPostsWithUser(0, 6);
        $classificacoes = App::get('database')->selectAll('classificacoes');
        foreach ($posts as $post) {
            $post->classificacoes = App::get('database')->selectPostsWithClassification($post->id);
        }
        return view('site/paginaDePosts', compact('posts', 'classificacoes'));
    }

    public function exibirPostIndividual($id)
    {
        $post = App::get('database')->selectPostWithUserById($id);

        $classificacoes = App::get('database')->selectPostsWithClassification($id);

        $post->classificacoes = $classificacoes;

        return view('site/postIndividual', compact('post'));
    }

    public function favoritarPublicacao()
    {
        $id_post = $_POST['post_id'];
        $id_usuario = $_POST['usuario_id'];

        App::get('database')->insereFavoritos($id_post, $id_usuario);

        header("Location: /publicacoes");

        //tratar na controller ficar mais otimizado 
    }

    public function exibirFavoritos()
    {
        $posts = App::get('database')->selectPostsWithUser(0, 6);
        $classificacoes = App::get('database')->selectAll('classificacoes');
        foreach ($posts as $post) {
            $post->classificacoes = App::get('database')->selectPostsWithClassification($post->id);
        }
        return view('site/favoritos', compact('posts', 'classificacoes'));
    }
}
