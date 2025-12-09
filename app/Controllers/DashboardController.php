<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class DashboardController
{
    
    public function index()
    {
        session_start();

        $total_post = App::get('database')->countAll('publicacoes');
        $total_user = App::get('database')->countAll('usuarios');

        // Busca o usuário logado (inclusive imagem)
        $usuario = App::get('database')->findUserById($_SESSION['id']);

        return view('admin/dashboard', compact('total_post', 'total_user', 'usuario'));
    }
}