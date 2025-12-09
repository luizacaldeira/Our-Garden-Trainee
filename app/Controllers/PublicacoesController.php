<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{

    public function index()
    {
        // Paginação
        $page = isset($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 1;
        $itensPage = 5;
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
            header("Location: /posts?page=" . $totalPages);
            exit;
        }

        $classificacoes = App::get('database')->selectAll('classificacoes');
        
        foreach ($posts as $post) {
            $post->classificacoes = App::get('database')->selectPostsWithClassification($post->id);
        }

        return view('admin/listaPosts', compact('posts', 'classificacoes', 'page', 'totalPages'));
    }

    public function create() {
        session_start();
        $imagemTemporaria = $_FILES['imagemPublicacao']['tmp_name'];
        $nomeImagem= sha1(uniqid($_FILES['imagemPublicacao']['name'], true)) . "." . pathinfo($_FILES['imagemPublicacao']['name'],PATHINFO_EXTENSION) ;

        $caminhoImagem = "public/assets/imagensPosts/" . $nomeImagem; 
        move_uploaded_file($imagemTemporaria, $caminhoImagem);

        $cuidados = $_POST['cuidadosPlanta'];

        $parameters = [
            "titulo" => $_POST['tituloPublicacao'],
            "descricao" => $_POST['descricaoPublicacao'],
            "nome_planta" => $_POST['nomePlanta'],
            "sobre" => $_POST['sobrePlanta'],
            "cuidados" => $cuidados,
            "imagem" => $caminhoImagem,
            "data_criacao" => date('Y-m-d'),
            "usuarios_id" => $_SESSION['id']
        ];

        App::get('database')->insert('publicacoes', $parameters);

        $id_publicacao = App::get('database')->lastInsertId();

        if (isset($_POST['classification']) && is_array($_POST['classification'])) {
            $pivotRecords = [];
            foreach ($_POST['classification'] as $id_classificacao) {
                $pivotRecords[] = [
                        'id_publicacao' => $id_publicacao,
                        'id_classificacao' => $id_classificacao
                ];
            }
            App::get('database')->insertPivot($pivotRecords);
        }

        header("Location: /posts");
    }


    public function edit(){

        if (
        isset($_FILES['imagem_post']) &&
        isset($_FILES['imagem_post']['error']) &&
        $_FILES['imagem_post']['error'] === 0 // upload bem-sucedido
    ) {

        $tmp = $_FILES['imagem_post']['tmp_name'];
        $ext = pathinfo($_FILES['imagem_post']['name'], PATHINFO_EXTENSION);

        // Gera nome único
        $novoNome = sha1(uniqid($_FILES['imagem_post']['name'], true)) . "." . $ext;

        // Caminho final
        $caminhoImagem = "public/assets/imagensPosts/" . $novoNome;

        // Move o arquivo
        move_uploaded_file($tmp, $caminhoImagem);

    } else {
        // Nenhuma imagem nova → mantém a antiga
        // (error = 4 ou qualquer outro erro)
        $caminhoImagem = $_POST['img_atual'];
    }

        $parameters = [
            "titulo" => $_POST['titulo'],
            "descricao" => $_POST['descricao'],
            "nome_planta" => $_POST['nome_planta'],
            "sobre" => $_POST['sobre'],
            "cuidados" => json_encode($_POST['cuidados']) ,
            "imagem" => $caminhoImagem,
            "usuarios_id" => 1
        ];

        $id = $_POST['id'];

        App::get('database')->update('publicacoes',$id,$parameters);
        header("Location: /posts");

    }

    public function delete(){
        $id = $_POST['id'];

        App::get('database')->delete('publicacoes',$id);
        header("Location: /posts");
    }
}