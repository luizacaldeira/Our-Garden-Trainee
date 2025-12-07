<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Publicações</title>
    <link rel="icon" href="/public/assets/4.png">
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <link rel="stylesheet" href="../../../public/css/favoritos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yeseva+One&display=swap" rel="stylesheet" />
</head>

<body>
    <?php include __DIR__ . '/../site/navbar.view.php' ?>
    <div class="pagina">
        <div class="container">
            <h2>FAVORITOS</h2>
        </div>

        <div class="listaCards">
            <?php foreach ($posts as $post): ?>
                <a class="card" href="/publicacoes/<?=$post->id?>">
                    <div class="infos">
                        <div class="profile">
                            <div class="nomeEFoto">
                                <div class="usuarioPosts">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="nomeUsuarioPosts">
                                    <p><?= $post->nome_usuario ?></p>
                                </div>
                            </div>
                            <div class="folhinhaPosts">
                                <i class="bi bi-leaf-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="imgPlantaPosts">
                        <img src="/<?= $post->imagem ?>">
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
                            <p><?= (new DateTime($post->data_criacao))->format('d/m/Y') ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="paginacao">
            <div class="elementosPaginacao">
                <li class="item-paginacao <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="arrow-left" href="?page=<?= max(1, $page - 1) ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
                <div class="numeros">
                    <li class="item-paginacao <?= $page == 1 ? 'active' : '' ?>">
                        <a class="page" href="?page=1">1</a>
                    </li>

                    <?php if ($page > 4): ?>
                        <li class="item-paginacao disabled"><span class="page">...</span></li>
                    <?php endif; ?>

                    <?php for ($page_number = max(2, $page - 2); $page_number <= min($totalPages - 1, $page + 2); $page_number++): ?>
                        <li class="item-paginacao <?= $page_number == $page ? 'active' : '' ?>">
                            <a class="page" href="?page=<?= $page_number ?>"><?= $page_number ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages - 3): ?>
                        <li class="item-paginacao disabled"><span class="page">...</span></li>
                    <?php endif; ?>

                    <?php if ($totalPages > 1): ?>
                        <li class="item-paginacao <?= $page == $totalPages ? 'active' : '' ?>">
                            <a class="page" href="?page=<?= $totalPages ?>"><?= $totalPages ?></a>
                        </li>
                    <?php endif; ?>
                </div>
                <li class="item-paginacao <?= $page >= $totalPages ? 'disabled' : '' ?>">
                    <a class="arrow-right" href="?page=<?= min($totalPages, $page + 1) ?>">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../site/footer.view.php' ?>
</body>

</html>