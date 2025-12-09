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
            <div class="pesquisaFavoritos">
                <div class="pesquisa">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Pesquise..." id="input-search">
                </div>
                <?php if (isset($_SESSION['id'])): ?>
                    <div class="btnPublicacoesFavoritasContainer">
                        <a href="/publicacoes/favoritos" class="btnPublicacoesFavoritas">Favoritos</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>


        <div class="listaCards">
            <?php foreach ($posts as $post): ?>
                <div class="card">
                    <a href="/publicacoes/<?=$post->id?>">
                    <div class="infos">
                        <div class="profile">
                            <div class="nomeEFoto">
                                <div class="fotoUsuarioPosts">
                                    <img src="/<?= $post->imagem_usuario ?>" alt="imagem">
                                </div>
                                <div class="nomeUsuarioPosts">
                                    <p><?= $post->nome_usuario ?></p>
                                </div>
                            </div>
                            <form action="/publicacoes/favoritar" method="post">
                                <div class="folhinhaPosts  <?= $post->favoritado ? 'ativo' : '' ?>">
                                    <?php if (isset($_SESSION['id'])): ?>
                                        <input type="hidden" name="post_id" value="<?= $post->id ?>">
                                        <button type="submit">
                                            <i class="bi <?= $post->favoritado ? 'bi-leaf-fill' : 'bi-leaf' ?>"></i>
                                        </button>
                                    <?php else: ?>
                                        <i class="bi bi-leaf blocked"></i>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="imgPlantaPosts">
                        <img src="<?= $post->imagem ?>">
                    </div>
                    <div class="conteudo">
                        <h3><?= $post->titulo ?></h3>
                        <p class="pMaluco"><?= $post->descricao ?></p>
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
                </div>
            <?php endforeach; ?>
        </div>

        <div class="paginacaoPosts">
            <div class="paginacaoPostsConteudo">
                <?php $searchParam = isset($_GET['pesquisarPublicacoes']) ? '&pesquisarPublicacoes=' . urlencode($_GET['pesquisarPublicacoes']) : ''; ?>

                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="arrow-left" href="?page=<?= max(1, $page - 1) ?><?= $searchParam ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>

                <div class="pages">
                    <li class="page-item <?= $page == 1 ? 'active' : '' ?>">
                        <a class="page" href="?page=1<?= $searchParam ?>">1</a>
                    </li>

                    <?php if ($page > 4): ?>
                        <li class="page-item disabled"><span class="page">...</span></li>
                    <?php endif; ?>

                    <?php for ($page_number = max(2, $page - 2); $page_number <= min($totalPages - 1, $page + 2); $page_number++): ?>
                        <li class="page-item <?= $page_number == $page ? 'active' : '' ?>">
                            <a class="page" href="?page=<?= $page_number ?><?= $searchParam ?>"><?= $page_number ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages - 3): ?>
                        <li class="page-item disabled"><span class="page">...</span></li>
                    <?php endif; ?>

                    <?php if ($totalPages > 1): ?>
                        <li class="page-item <?= $page == $totalPages ? 'active' : '' ?>">
                            <a class="page" href="?page=<?= $totalPages ?><?= $searchParam ?>"><?= $totalPages ?></a>
                        </li>
                    <?php endif; ?>
                </div>

                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                    <a class="arrow-right" href="?page=<?= min($totalPages, $page + 1) ?><?= $searchParam ?>">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../site/footer.view.php' ?>

    <script src="../../../public/js/buscaPaginaPosts.js"></script>
</body>

</html>