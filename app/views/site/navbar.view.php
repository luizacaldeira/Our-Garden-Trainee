<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Navbar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yeseva+One&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="../../../public/css/styles.css">

    <link rel="stylesheet" href="../../../public/css/navbar.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body>
    <div class="navbarGlobal">

        <div class="navbar" id="navbar">

            <img src="../../../public/assets/Escrito verde claro vazio.png" class="navbarLogo">

            <div class="navbarContent">
                <a class="navbarText" href = "/">Home</a>
                <div class="navbarDivider"></div>
                <a class="navbarText" href = "/publicacoes">Publicações</a>
                <div class="navbarDivider"></div>
                <a class="navbarLoginButton" href = "/login">Login</a>
            </div>
        </div>

        <div class="navbarMobile" id="navbarMobile">

            <div class="sanduba">
                <i class="bi bi-list" id="abrirSanduba"></i>
                <i class="bi bi-x-lg" id="fecharSanduba"></i>
                <img src="../../../public/assets/Escrito verde claro vazio.png" class="navbarLogo">
            </div>            

            <div class="navbarContentMobile" id="navbarContentMobile">
                <a class="navbarTextMobile" href = "/">Home</a>
                <div class="navbarDividerMobile"></div>
                <a class="navbarTextMobile" href = "/publicacoes">Publicações</a>
                <div class="navbarDividerMobile"></div>
                <a class="navbarLoginButtonMobile" href = "/login">Login</a>
            </div>
        </div>
    </div>
    <script src="../../../public/js/navbar.js"></script>
</body>

</html>