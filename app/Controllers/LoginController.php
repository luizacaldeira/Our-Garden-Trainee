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

        if($user != false){
            session_start();
            $_SESSION['id'] = $user->id;

            header("Location: /dashboard");
        }else{
            session_start();
            $_SESSION['mensagemErro'] = 'Usuário e/ou senha incorretos';

            header("Location: /login");
        };

    }
}