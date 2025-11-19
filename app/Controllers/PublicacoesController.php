<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{

    public function index()
    {
        $posts = App::get('database')->selectPostsWithUser();
        $classificacoes = App::get('database')->selectAll('classificacoes');

        foreach ($posts as $post) {
            $post->cuidados;
            $post->classificacoes = App::get('database')->selectPostsWithClassification($post->id);
        }

        return view('admin/listaPosts', compact('posts', 'classificacoes'));
    }

    public function create()
    {

        $imagemTemporaria = $_FILES['imagemPublicacao']['tmp_name'];
        $nomeImagem = sha1(uniqid($_FILES['imagemPublicacao']['name'], true)) . "." . pathinfo($_FILES['imagemPublicacao']['name'], PATHINFO_EXTENSION);
        $caminhoImagem = "public/assets/imagensPosts/" . $nomeImagem;
        move_uploaded_file($imagemTemporaria, $caminhoImagem);

        $parameters = [
            "titulo" => $_POST['tituloPublicacao'],
            "descricao" => $_POST['descricaoPublicacao'],
            "nome_planta" => $_POST['nomePlanta'],
            "sobre" => $_POST['sobrePlanta'],
            "cuidados" => $_POST['cuidadosPlanta'],
            "imagem" => $caminhoImagem,
            "data_criacao" => date('Y-m-d'),
            "usuarios_id" => 1
        ];

        App::get('database')->insert('publicacoes', $parameters);

        $id_publicacao = App::get('database')->lastInsertID();
        if (isset($_POST['classification']) && is_array($_POST['classification'])) {
            $records_aux = [];
            foreach ($_POST['classification'] as $id_classificacao) {
                $records_aux[] = [
                    "id_publicacao" => $id_publicacao,
                    "id_classificacao" => $id_classificacao,
                ];
            }

            App::get('database')->insertPivot($records_aux);
        }

        header("Location: /posts");
    }


    public function edit()
    {
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
            "cuidados" => json_encode($_POST['cuidados']),
            "imagem" => $caminhoImagem,
            "usuarios_id" => 1
        ];

        $id = $_POST['id'];

        App::get('database')->update('publicacoes', $id, $parameters);
        header("Location: /posts");
    }

    public function delete (){
        $id = $_POST['id'];
        App::get('database')->delete('publicacoes', $id);
        header("Location: /posts");
    }
}
