<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Publicações</title>
    <link rel="icon" href="/public/assets/4.png">
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <link rel="stylesheet" href="../../../public/css/paginaDePosts.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yeseva+One&display=swap" rel="stylesheet" />
</head>
<body>
    <?php include __DIR__ . '/../site/navbar.view.php' ?>
    <div class="pagina">
        <div class="container">
            <h2>ÚLTIMAS PUBLICAÇÕES</h2>
            <div class="pesquisaFunil">
                <div class="pesquisa">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Pesquise...">
                </div>
            </div>
        </div>

        <div class="listaCards">
            <?php foreach($posts as $post): ?>
            <div class="card">
                <div class="infos">
                    <div class="profile">
                        <div class="nomeEFoto">
                            <div class="usuarioPosts">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="nomeUsuarioPosts">
                                <p><?= $post->usuarios_id ?></p>
                            </div>
                        </div>
                        <div class="folhinhaPosts">
                        <?php if (isset($_SESSION['id'])): ?>
                            <i class="bi bi-leaf"></i>
                            <i class="bi bi-leaf-fill"></i>
                        <?php else: ?>
                            <i class="bi bi-leaf blocked"></i>
                            <i class="bi bi-leaf-fill blocked"></i>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="imgPlantaPosts">
                    <img src="<?= $post->imagem ?>">
                </div>
                <div class="conteudo">
                    <h3><?= $post->titulo ?></h3>
                    <p><?= $post->descricao ?></p>
                    <div class="classificacoes">
                        <?php foreach ($post->classificacoes as $classificacao): ?>
                            <p><?= $classificacao->nome ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="hora">
                        <i class="bi bi-calendar-fill"></i>
                        <p><?= $post->data_criacao ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="paginacao">
            <div class="elementosPaginacao">
                <div class="arcos">
                    <i class="bi bi-chevron-left"></i>
                    <div class="numeros">
                        <div class="item-paginacao">
                            <p>1</p>
                        </div>
                        <div class="item-paginacao">
                            <p>2</p>
                        </div>
                        <div class="item-paginacao">
                            <p>3</p>
                        </div>
                        <div class="item-paginacao">
                            <p>4</p>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/../site/footer.view.php' ?>
</body>
</html>