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
    <link rel="stylesheet" href="../../../public/css/recuperarSenha.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <title>Recuperar Senha</title>
    <link rel="icon" href="/public/assets/4.png">
</head>

<body>

    <div class="loginBackground">
        <div class="loginBackgroundImg"></div>
        <div class="loginBackgroundColor"></div>
    </div>

    <div class="loginBox">
        <div class="loginEnvelope" id="loginEnvelope">
            <a class="loginBoxImg" href="/"></a>

            <div class="loginBoxForm">
                <div class="loginBoxTitle">
                    <h1>Recuperação de Senha</h1>
                </div>

                <div class="loginData">
                    <div class="loginBoxSubtitle">
                        <h2>Digite seu email para recuperar a senha.</h2>
                    </div>
                    <form action="/login/enviaEmail" method="POST">
                        <div class="loginBoxId">
                            <div class="loginBoxEmail">
                                <p>Email</p>
                            </div>
                            <div class="loginInput">
                                <i class="bi bi-envelope"></i>
                                <input class="inputLogin" type="email" name="email" placeholder="Digite seu email...">
                            </div>
                        </div>
                </div>
                <div class="loginVerification">
                    <button class="loginBoxButton" type="submit">
                        <h3>Recuperar Senha</h3>
                    </button>
                    <div class="loginBoxEnd">
                        <p>Voltar para o </p>
                        <a class="loginRegisterButton" href="/login">Login</a>
                    </div>
                </div>
                <div class="loginBoxXoxomidias">
                    <a class="a" href="https://www.instagram.com/codejr" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a class="a" href="https://www.facebook.com/codeempresajunior" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a class="a" href="https://www.linkedin.com/company/codejr/" target="_blank"><i class="bi bi-linkedin"></i></a>
                    <a class="a" href="https://api.whatsapp.com/send/?phone=5532991519313&text&type=phone_number&app_absent=0" target="_blank"><i class="bi bi-telephone-fill"></i></a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>