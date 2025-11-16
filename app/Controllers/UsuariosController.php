<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{

    public function index()
    {
        $users = App::get('database')->selectAll('usuarios');
        return view('admin/listaUsuarios', compact('users'));
    }

    public function criar()
    {
        $imagemTemporaria= $_FILES['imagemUsuario']['tmp_name'];
        $nomeImagem= sha1(uniqid($_FILES['imagemUsuario']['name'], true)) . "." . pathinfo($_FILES['imagemUsuario']['name'],PATHINFO_EXTENSION) ;

        $caminhoImagem= "public/assets/imagensUsuarios/" . $nomeImagem; 
        move_uploaded_file($imagemTemporaria, $caminhoImagem);

        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'imagem' => $caminhoImagem
        ];   

        App::get('database')->insert('usuarios', $parameters);

        header('Location: /usuarios');
    }

    public function editar()
    {
        $id = $_POST['id'];

        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'imagem' => 'imagem1'        
        ];

        App::get('database')->update('usuarios', $id, $parameters);

        header ('Location: /usuarios');

    }

    public function deletar()
    {
        $id = $_POST['id'];

        App::get('database')->delete('usuarios', $id);

        header ('Location: /usuarios');
    }
}