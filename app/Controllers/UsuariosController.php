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
}