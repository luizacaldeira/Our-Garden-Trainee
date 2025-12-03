<?php

namespace App\Controllers;

use App\Core\App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    public function recuperar()
    {
        return view('site/recuperarSenha');
    }

    public function enviaEmail() {

        $email = $_POST['email'];

        $usuario = App::get('database')->selectWhere('usuarios', [
            'email' => $email
        ]);

        if (!$usuario) {
            session_start();
            $_SESSION['mensagemErro'] = "Este email não está cadastrado.";
            header("Location: /login/recuperar");
            exit;
        }

        $mail = new PHPMailer(true);

        try {
            //CONFIG SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ourgarden.teste@gmail.com';
            $mail->Password = 'jfud skny sezu vzga';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //REMETENTE
            $mail->setFrom('ourgarden.teste@gmail.com', 'OurGarden');

            //DESTINATÁRIO DINÂMICO
            $mail->addAddress($email);

            //CONTEÚDO
            $mail->isHTML(true);
            $mail->Subject = 'Recuperacao de senha - OurGarden';

            $mail->Body = "<h2>Sua senha é:</h2><p>{$usuario->senha}</p>";

            $mail->AltBody = "Sua senha é: {$usuario->senha}";

            $mail->send();

            //REDIRECIONA PARA O LOGIN
            header("Location: /login");

        } catch (Exception $e) {
            echo "Erro ao enviar email: {$mail->ErrorInfo}";
        }
    }
}
