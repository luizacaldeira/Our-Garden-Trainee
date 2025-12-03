<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class LoginController
{

    public function index()
    {
        return view('site/login');
    }

    public function loginVerification()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $user = App::get('database')->verificarLogin($email, $senha);

        if ($user != false) {
            session_start();
            $_SESSION['id'] = $user->id;
            $_SESSION['tipo_usuario'] = $user->tipo_usuario;
            $_SESSION['nome'] = $user->nome;

            header("Location: /dashboard");
        } else {
            session_start();
            $_SESSION['mensagemErro'] = 'Usuário e/ou senha incorretos';

            header("Location: /login");
        };
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: /login");
    }

    public function logoutSidebar()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: /");
    }

    public function register()
    {
        $parameters = [
            'nome' => $_POST['nomeRegister'],
            'email' => $_POST['emailRegister'],
            'senha' => $_POST['senhaRegister'],
            'imagem' => 'public/assets/foto perfil.png',
            'tipo_usuario' => 1
        ];

        App::get('database')->insert('usuarios', $parameters);

        header('Location: /');
    }
}
