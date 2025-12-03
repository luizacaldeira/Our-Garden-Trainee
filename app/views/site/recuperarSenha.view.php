<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="/public/css/login.css">
</head>
<body>

<div class="loginBox">
    <h1>Recuperar Senha</h1>
    <p>Digite seu e-mail para enviarmos sua senha.</p>

    <form action="/login/enviaEmail" method="POST">
        <label>Email</label>
        <input type="email" name="email" required placeholder="Digite seu e-mail">

        <button type="submit">Enviar</button>
    </form>

    <br>
    <a href="/login">Voltar ao Login</a>
</div>

</body>
</html>