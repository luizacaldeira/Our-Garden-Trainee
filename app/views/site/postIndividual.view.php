<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="../../../public/css/postIndividual.css">

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yeseva+One&display=swap" rel="stylesheet" />

    <title>Post individual</title>
    <link rel="icon" href="/public/assets/4.png">
</head>

<body>
    <?php include __DIR__ . '/../site/navbar.view.php' ?>
    <main>
        <section class="hero-section">

            <div class="post-container">
                <div class="post">
                    <div class="image-container">
                        <img src="/<?=$post->imagem?>" alt="imagem de planta">
                    </div>
                    <div class="content">
                        <div class="content-header">
                            <div class="header-title">
                                <p><?=$post->titulo?></p>
                            </div>
                        </div>
                        <div class="content-main">
                            <div class="class-container">
                                <?php foreach ($post->classificacoes as $classificacao): ?>
                                <div class="classification">
                                    <p><?= $classificacao->nome ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="post-description">
                                <p><?=$post->descricao?></p>
                            </div>
                        </div>
                        <div class="content-footer">
                            <div class="author">
                                <img src="../../../public/assets/perfil-icon.svg" alt="ícone de perfil">
                                <p><?=$post->nome_usuario?></p>
                            </div>
                            <div class="date">
                                <img src="../../../public/assets/calendar-icon.svg" alt="ícone de calendário">
                                <i><?= (new DateTime($post->data_criacao))->format('d/m/Y') ?></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="plant-infos-container">
                    <div class="title">
                        Informações adicionais sobre a planta
                    </div>
                    <div class="container">
                        <span>Nome</span>
                        <div class="plant-name">
                            <?=$post->nome_planta?>
                        </div>
                    </div>
                    <div class="container">
                        <span>Classificação</span>
                        <ul class="classifications">
                            <?php foreach ($post->classificacoes as $classificacao): ?>
                            <li class="classification">
                                <strong><?= $classificacao->nome ?>:</strong> <?= $classificacao->descricao ?>
                            </li>
                             <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="container">
                        <span>Sobre</span>
                        <div class="plant-about">
                            <?=$post->sobre?>
                        </div>
                    </div>
                    <div class="container">
                        <span>Cuidados</span>
                        <ul class="cares">
                            <?php foreach (json_decode($post->cuidados) as $cuidado): ?>
                            <li class="care"> <?= $cuidado ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="show-more-container">
                    <button id="btn-show-more" class="btn-show-more">
                        <img src="../../../public/assets/arrow-down-white-icon.svg" alt="ícone de seta para baixo">
                        Saiba mais sobre a planta
                    </button>
                </div>

            </div>
        </section>
    </main>
    <?php include __DIR__ . '/../site/footer.view.php' ?>
    <script src="../../../public/js/postIndividual.js"></script>
</body>

</html>