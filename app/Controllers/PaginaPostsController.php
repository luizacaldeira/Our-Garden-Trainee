<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PaginaPostsController
{
    public function index()
    {
        session_start();

        $posts = App::get('database')->selectPostsWithUser(0, 6);
        $classificacoes = App::get('database')->selectAll('classificacoes');
        foreach ($posts as $post) {
            $post->classificacoes = App::get('database')->selectPostsWithClassification($post->id);
            $post->favoritado = App::get('database')->isFavorito($post->id, $_SESSION['id']);
        }
        return view('site/paginaDePosts', compact('posts', 'classificacoes'));
    }

    public function exibirPostIndividual($id)
    {
        session_start();

        $post = App::get('database')->selectPostWithUserById($id);

        $classificacoes = App::get('database')->selectPostsWithClassification($id);

        $post->classificacoes = $classificacoes;

        return view('site/postIndividual', compact('post'));
    }

    public function favoritarPublicacao()
    {
        session_start();

        $id_post = $_POST['post_id'];
        $id_usuario = $_SESSION['id'];

        App::get('database')->insereFavoritos($id_post, $id_usuario);

        header("Location: /publicacoes");

        //tratar na controller ficar mais otimizado 
    }

    public function exibirFavoritos()
    {
        session_start();

        $id_usuario = $_SESSION['id'];

        $posts = App::get('database')->selectFavoritosByUser($id_usuario);

        foreach ($posts as $post) {
            $post->classificacoes = App::get('database')->selectPostsWithClassification($post->id);
        }

        // Paginação
        $page = isset($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 1;
        $itensPage = 5;
        $inicio = ($page - 1) * $itensPage;
        $rows_count = count($posts);
        
        $totalPages = max(1, ceil($rows_count / $itensPage));
        
        if ($page <= 0) {
            return redirect('site/listaPosts');
        }

        if ($page > $totalPages) {
            header("Location: /posts?page=" . $totalPages);
            exit;
        }

        return view('site/favoritos', compact('posts', 'page', 'totalPages'));
    }
}
