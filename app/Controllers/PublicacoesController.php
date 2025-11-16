<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PublicacoesController
{

    public function index()
    {
        $posts = App::get('database')->selectPostsWithUser();
        return view('admin/listaPosts' ,compact('posts'));
    }

    public function create() {

        $imagemTemporaria = $_FILES['imagemPublicacao']['tmp_name'];
        $nomeImagem= sha1(uniqid($_FILES['imagemPublicacao']['name'], true)) . "." . pathinfo($_FILES['imagemPublicacao']['name'],PATHINFO_EXTENSION) ;

        $caminhoImagem = "public/assets/imagensPosts/" . $nomeImagem; 
        move_uploaded_file($imagemTemporaria, $caminhoImagem);

        $parameters = [
            "titulo" => $_POST['tituloPublicacao'],
            "descricao" => $_POST['descricaoPublicacao'],
            "nome_planta" => $_POST['nomePlanta'],
            "sobre" => $_POST['sobrePlanta'],
            "cuidados" => json_encode($_POST['cuidadosPlanta']) ,
            "imagem" => $caminhoImagem,
            "data_criacao" => date('Y-m-d'),
            "usuarios_id" => 1
        ];

        // $classifications = $_POST['classification[]'];

        App::get('database')->insert('publicacoes', $parameters);

        header("Location: /posts");
    }

    public function edit($id){
        $id = $_GET['id'];

        App::get('database')->selectOne($id);
        return view ('admin/listPosts' , compact('posts'));
    }

    public function updade($id){
        $parameters = [
            "titulo" => $_POST['tituloPublicacao'],
            "descricao" => $_POST['descricaoPublicacao'],
            "nome_planta" => $_POST['nomePlanta'],
            "sobre" => $_POST['sobrePlanta'],
            "cuidados" => json_encode($_POST['cuidadosPlanta']) ,
            "imagem" => $_POST['imagemPublicacao'],
            "data_criacao" => date('Y-m-d'),
            "usuarios_id" => 1
        ];

        App::get('database')->updade('publicacoes','$id','$parameters');
        header("Location: /posts");

    }
}