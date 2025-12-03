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

    public function enviaEmail()
    {
        $mail = new PHPMailer(true);

        try {
            // CONFIG SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ourgarden.teste@gmail.com';       // troque aqui
            $mail->Password   = 'jfud skny sezu vzga';      // troque aqui
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Permitir localhost sem SSL
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            // REMETENTE
            $mail->setFrom('ourgarden.teste@gmail.com', 'OurGarden');

            // DESTINATÁRIO
            $mail->addAddress('ourgarden.teste@gmail.com');

            // CONTEÚDO
            $mail->isHTML(true);
            $mail->Subject = 'Teste de Email no Localhost';
            $mail->Body    = '<h2>Email enviado com sucesso pelo localhost!</h2>';
            $mail->AltBody = 'Email enviado com sucesso pelo localhost!';

            $mail->send();

            echo 'Email enviado com sucesso!';
        } catch (Exception $e) {
            echo "Erro ao enviar email: {$mail->ErrorInfo}";
        }
    }
}
