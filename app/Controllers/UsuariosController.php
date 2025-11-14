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
        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'imagem' => 'imagem'
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