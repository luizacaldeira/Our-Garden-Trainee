<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yeseva+One&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <link rel="stylesheet" href="../../../public/css/login.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <title>Login</title>
    <link rel="icon" href="/public/assets/4.png">
</head>

<body>
    <?php session_start(); ?>
    <div class="loginBackground">
        <div class="loginBackgroundImg"></div>
        <div class="loginBackgroundColor"></div>
    </div>

    <div class="loginBox">
    <div class="loginEnvelope" id="loginEnvelope">
        <a class="loginBoxImg" href="/"></a>

        <div class="registerBoxForm">
            <div class="registerBoxTitle">
                <h1>Registre-se</h1>
            </div>

            <div class="registerData">
                <div class="registerBoxSubtitle">
                    <h2>Digite suas informações para registrar-se.</h2>
                </div>
                <form action="/login/register" method="POST">
                    <div class="registerBoxId">
                        <div class="registerBoxNome">
                            <p>Nome</p>
                        </div>
                        <div class="registerInput">
                            <input class="inputLogin" type="text" name="nomeRegister" placeholder="Digite seu nome..." required>
                        </div>
                    </div>
                    <div class="registerBoxId">
                        <div class="registerBoxEmail">
                            <p>Email</p>
                        </div>
                        <div class="registerInput">
                            <i class="bi bi-envelope"></i>
                            <input class="inputLogin" type="email" name="emailRegister" placeholder="Digite seu email..." required>
                        </div>
                    </div>
                    <div class="registerBoxId">
                        <div class="registerBoxSenha">
                            <p>Senha</p>
                        </div>
                        <div class="registerInput">
                            <div class="registerLock">
                                <i class="bi bi-lock"></i>
                                <input class="inputRegisterPassword" id="inputLoginPassword" name="senhaRegister" type="password" placeholder="Digite sua senha..." required>
                            </div>
                            <div class="divOlhos" id="divOlhos">
                                <i class="bi bi-eye-slash" id="olho"></i>
                                <i class="bi bi-eye" id="olhoAberto"></i>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="registerVerification">
                <button class="registerBoxButton" type="submit">
                    <h3>Registrar</h3>
                </button>
                <div class="registerBoxEnd">
                    <p>Já tem uma conta?</p>
                    <p class="registerEnterButton" id="registerEnterButton">Entrar</p>
                </div>
            </div>
            </form>

            <div class="loginBoxXoxomidias">
                <a class="a" href="https://www.instagram.com/codejr" target="_blank"><i class="bi bi-instagram"></i></a>
                <a class="a" href="https://www.facebook.com/codeempresajunior" target="_blank"><i class="bi bi-facebook"></i></a>
                <a class="a" href="https://www.linkedin.com/company/codejr/" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a class="a" href="https://api.whatsapp.com/send/?phone=5532991519313&text&type=phone_number&app_absent=0" target="_blank"><i class="bi bi-telephone-fill"></i></a>
            </div>
        </div>

        <div class="loginBoxForm">
            <div class="loginBoxTitle">
                <h1>Bem-vindo!</h1>
            </div>

            <div class="loginData">
                <div class="loginBoxSubtitle">
                    <h2>Digite suas credenciais para continuar.</h2>
                </div>
                <form action="/login" method="POST">
                    <div class="mensagemErro">
                        <?php
                        if(isset($_SESSION['mensagemErro']))
                            echo $_SESSION['mensagemErro'];
                        unset($_SESSION['mensagemErro']);
                        ?>
                    </div>
                    <div class="loginBoxId">
                        <div class="loginBoxEmail">
                            <p>Email</p>
                        </div>
                        <div class="loginInput">
                            <i class="bi bi-envelope"></i>
                            <input class="inputLogin" type="email" name="email" placeholder="Digite seu email..." required>
                        </div>
                    </div>
                    <div class="loginBoxId">
                        <div class="loginBoxSenha">
                            <p>Senha</p>
                        </div>
                        <div class="loginInput">
                            <div class="loginLock">
                                <i class="bi bi-lock"></i>
                                <input class="inputLoginPassword" id="inputLoginPassword" name="senha" type="password" placeholder="Digite sua senha..." required>
                            </div>
                            <div class="divOlhos" id="divOlhos">
                                <i class="bi bi-eye-slash" id="olho"></i>
                                <i class="bi bi-eye" id="olhoAberto"></i>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="loginVerification">
                <div class="loginBoxPassword">
                    <a href="/login/recuperar">Esqueceu a senha?</a>
                </div>
                <button class="loginBoxButton" type="submit">
                    <h3>Login</h3>
                </button>
                <div class="loginBoxEnd">
                    <p>Não tem uma conta?</p>
                    <p class="loginRegisterButton" id="loginRegisterButton">Registre-se</p>
                </div>
            </div>
            </form>

            <div class="loginBoxXoxomidias">
                <a class="a" href="https://www.instagram.com/codejr" target="_blank"><i class="bi bi-instagram"></i></a>
                <a class="a" href="https://www.facebook.com/codeempresajunior" target="_blank"><i class="bi bi-facebook"></i></a>
                <a class="a" href="https://www.linkedin.com/company/codejr/" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a class="a" href="https://api.whatsapp.com/send/?phone=5532991519313&text&type=phone_number&app_absent=0" target="_blank"><i class="bi bi-telephone-fill"></i></a>
            </div>
        </div>
    </div>
    </div>

    <script src="../../../public/js/paginaLogin.js"></script>
</body>

</html>