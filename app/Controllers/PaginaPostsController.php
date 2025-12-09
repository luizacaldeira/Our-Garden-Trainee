<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PaginaPostsController
{
    public function index()
    {
        session_start();

        // Paginação
        $page = isset($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 1;
        $itensPage = 6;
        $inicio = ($page - 1) * $itensPage;

        // Busca
        $termo = isset($_GET['pesquisarPublicacoes']) ? trim($_GET['pesquisarPublicacoes']) : '';

        if (!empty($termo)) {
            // Com busca
            $todosPosts = App::get('database')->buscaPublicacoes($termo);
            $rows_count = count($todosPosts);
            $posts = array_slice($todosPosts, $inicio, $itensPage);
        } else {
            // Sem busca
            $rows_count = App::get('database')->countAll('publicacoes');
            $posts = App::get('database')->selectPostsWithUser($inicio, $itensPage);
        }

        $totalPages = max(1, ceil($rows_count / $itensPage));

        // Garante que a página não seja maior que o total
        if ($page > $totalPages) {
            header("Location: /publicacoes?page=" . $totalPages);
            exit;
        }

        $classificacoes = App::get('database')->selectAll('classificacoes');
        
        foreach ($posts as $post) {
            $post->classificacoes = App::get('database')->selectPostsWithClassification($post->id);
        }

        return view('site/paginaDePosts', compact('posts', 'classificacoes', 'page', 'totalPages'));
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
