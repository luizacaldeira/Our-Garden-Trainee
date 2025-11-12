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
}