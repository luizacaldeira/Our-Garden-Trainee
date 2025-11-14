<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yeseva+One&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> -->

    <!-- CSS -->
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <link rel="stylesheet" href="../../../public/css/listaPosts.css">
    <link rel="stylesheet" href="../../../public/css/modalEditarPublicacao.css">
    <link rel="stylesheet" href="../../../public/css/modalCriarPublicacao.css">
    <link rel="stylesheet" href="../../../public/css/modalExcluirPublicacao.css">
    <link rel="stylesheet" href="../../../public/css/modalVisualizarPublicacao.css">

    <title>Lista de Posts</title>
</head>

<body>
    <div class="backgroundListaPosts">
        <div class="mainListaPosts">
            <div class="superiorListaPosts">
                <div class="pesquisaPosts">
                    <img src="../../../public/assets/lupa-icon.svg" alt="ícone de lupa" class="lupa-icon">
                    <input type="text" name="pesquisarUsuarios" id="input-search" class="input-search"
                        placeholder="Pesquisar publicação...">
                </div>
                <div class="perfilListaPosts">
                    <img src="../../../public/assets/profile-icon.svg" alt="ícone de perfil" class="profile-icon">
                    <div class="nomePerfil">
                        <strong>Julia Rodrigues</strong>
                        <p>administrador</p>
                    </div>
                </div>
            </div>

            <div class="superiorTabelaPosts">
                <div class="tituloTabelaPosts">
                    <p>Publicações</p>
                </div>
                <button class="botoeslistaPosts" id="botoeslistaPosts">
                    <img src="../../../public/assets/plus-icon.svg" alt="ícone de mais">
                    Nova publicação
                </button>
            </div>

            <div class="tabelaPostsContent">
                <div class="tabelaPostsMeio">
                    <table class="tabelaPosts">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TÍTULO</th>
                                <th>AUTOR</th>
                                <th>DATA</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($posts as $post): ?>
                            <tr>
                                <td><?= $post->id ?></td>
                                <td><strong><?= $post->titulo ?></strong></td>
                                <td><?= $post->nome_usuario ?></td>
                                <td><?= $post->data_criacao ?></td>
                                <td>
                                    <div class="botoesAcoes">
                                        <button class="btn-actions"><img src="../../../public/assets/eye-icon.svg"
                                                alt="ícone de olho"
                                                onclick="abrirModal('modalViewPublication<?= $post->id ?>', 'filtro')"></button>
                                        <button class="btn-actions"><img src="../../../public/assets/pencil-icon.svg"
                                                alt="ícone de lápis"
                                                onclick="abrirModal('modalEditPublication<?= $post->id ?>','filtro')"></button>
                                        <button class="btn-actions"><img src="../../../public/assets/trash-icon.svg"
                                                alt="ícone de lixeira"
                                                onclick="abrirModal('modalDeletePublication<?= $post->id ?>','filtro')"></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="paginacaoPosts">
                        <div class="paginacaoPostsConteudo">
                            <button class="arrow-left"><img src="../../../public/assets/arrow-left-icon.svg"
                                    alt="ícone de seta para esquerda"></button>
                            <div class="pages">
                                <button class="page">1</button>
                                <button class="page">2</button>
                                <button class="page">3</button>
                                <button class="page">4</button>
                                <button class="page">...</button>
                            </div>
                            <button class="arrow-right"><img src="../../../public/assets/arrow-right-icon.svg"
                                    alt="ícone de seta para direita"></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL CRIAR NOVA PUBLICAÇÃO -->
            <div class="filtro" id="filtro"></div>

            <div class="modal-create-publication" id="modalCreatePublication">
                <div class="modal-create-publication-header">
                    <img src="../../../public/assets/plus-circle-icon.svg" alt="ícone de mais">
                    <p>Criar nova publicação</p>
                </div>

                <div class="modal-create-publication-main">
                    <form class="create-publication-form" id="createPublicationForm" method="POST" action="/posts/create">
                        <section class="create-publication-container photo-container" id="photoContainer">
                            <div class="photo-container-content">
                                <input type="file" name="adicionar nova foto" id="addNewPhotoInput"
                                    onchange="exibirPreviewImagem('addNewPhotoInput', 'previewContent')"
                                    style="display: none;" required>
                                <label for="addNewPhotoInput" id="labelArquivo" class="label-photo-container">
                                    <div class="preview-content" id="previewContent">
                                        <img src="../../../public/assets/image-icon.svg"
                                            alt="ícone de adicionar nova imagem">
                                        <p>Selecione uma foto</p>
                                    </div>
                                </label>
                            </div>
                        </section>

                        <section class="create-publication-container" id="titleContainer">
                            <span>Título:</span>
                            <input type="text" name="título da publicação" id="inputTitleName"
                                placeholder="Digite o título da publicação..." required>
                        </section>

                        <section class="create-publication-container" id="descriptionContainer">
                            <span>Descrição:</span>
                            <input type="text" name="descrição da publicação" id="inputDescriptionName"
                                placeholder="Digite a descrição da publicação..." required>
                        </section>

                        <div class="div-name-classification">
                            <section class="create-publication-container" id="nameContainer">
                                <span>Nome:</span>
                                <input type="text" name="nome da planta" id="inputPlantName"
                                    placeholder="Digite o nome da planta..." required>
                            </section>

                            <section class="create-publication-container classification-container"
                                id="classificationContainer">
                                <span>Classificação:</span>
                                <button class="classification-button" id="btnClassification">
                                    <p>Escolha até 3 opções...</p>
                                    <img src="../../../public/assets/arrow-down-icon.svg" alt="seta para baixo"
                                        class="arrow-down-icon" id="arrowDownIcon">
                                    <img src="../../../public/assets/arrow-up-icon.svg" alt="seta para cima"
                                        class="arrow-up-icon" id="arrowUpIcon">
                                </button>
                                <div class="dropdown-classification" id="dropdownClassification">
                                    <label><input type="checkbox" value="Ornamentais" name="classification[]">
                                        Ornamentais</label>
                                    <label><input type="checkbox" value="Medicinais" name="classification[]">
                                        Medicinais</label>
                                    <label><input type="checkbox" value="Alimentícias" name="classification[]">
                                        Alimentícias</label>
                                    <label><input type="checkbox" value="Aromáticas" name="classification[]">
                                        Aromáticas</label>
                                    <label><input type="checkbox" value="Tóxicas" name="classification[]">
                                        Tóxicas</label>
                                    <label><input type="checkbox" value="Industriais" name="classification[]">
                                        Industriais</label>
                                    <label><input type="checkbox" value="Forrageiras" name="classification[]">
                                        Forrageiras</label>
                                    <label><input type="checkbox" value="Madeireiras" name="classification[]">
                                        Madeireiras</label>
                                    <label><input type="checkbox" value="Oleaginosas" name="classification[]">
                                        Oleaginosas</label>
                                    <label><input type="checkbox" value="Fibrosas" name="classification[]">
                                        Fibrosas</label>
                                    <label><input type="checkbox" value="Condimentares" name="classification[]">
                                        Condimentares</label>
                                </div>
                            </section>
                        </div>

                        <section class="create-publication-container" id="aboutContainer">
                            <span>Sobre:</span>
                            <input type="text" name="sobre a planta" id="inputAboutPlant"
                                placeholder="Digite informações sobre a planta...">
                        </section>

                        <section class="create-publication-container" id="caresContainer">
                            <span>Cuidados:</span>
                            <div class="add-cares" id="addCaresContainer">
                                <div class="input-cares-container">
                                    <input type="text" name="cuidados com a planta" id="inputCaresPlant"
                                        placeholder="Digite até 5 cuidados sobre a planta...">
                                    <button class="btn-add-care" id="btnAddCares">
                                        <img src="../../../public/assets/plus-circle-green-icon.svg"
                                            alt="ícone de mais">
                                    </button>
                                </div>
                                <ul class="ul-cares" id="ulCares"></ul>
                            </div>
                        </section>

                        <section class="modal-create-buttons">
                            <button class="btn-cancel-publication" id="btnCancelPublication">Cancelar</button>
                            <button type="submit" class="btn-create-publication"
                                id="btnCreatePublication">Criar</button>
                        </section>
                    </form>
                </div>

            </div>

            <!-- MODAL VISUALIZAR PUBLICAÇÃO -->
            <div class="modal-view-publication" id="modalViewPublication<?= $post->id ?>">
                <div class="modal-view-publication-header">
                    <img src="../../../public/assets/eye-icon-white.svg" alt="ícone de olho">
                    <p>Visualizar publicação</p>
                </div>

                <div class="modal-view-publication-main">
                    <section class="view-publication-container view-photo-container" id="viewPhotoContainer">
                        <div class="view-photo-container-content">
                            <img src="../../../public/assets/code-logo.png" alt="">
                        </div>
                    </section>

                    <section class="view-publication-container" id="viewTitleContainer">
                        <span>Título:</span>
                        <div class="view-input">
                            <p><?= $post->titulo ?></p>
                        </div>
                    </section>

                    <section class="view-publication-container" id="viewDescriptionContainer">
                        <span>Descrição:</span>
                        <div class="view-input">
                            <p><?= $post->descricao ?></p>
                        </div>
                    </section>

                    <section class="view-publication-container" id="viewNameContainer">
                        <span>Nome:</span>
                        <div class="view-input">
                            <p><?= $post->nome_planta ?></p>
                        </div>
                    </section>

                    <section class="view-publication-container classification-container" id="classificationContainer">
                        <span>Classificação:</span>
                        <div class="view-input view-input-classification">
                            <ul class="view-classification-ul">
                                <li class="view-classification-li">
                                    <strong>Ornamental:</strong> é cultivada principalmente pela beleza estética
                                    (flores, folhas, formato ou cor), e não pelo uso alimentar ou medicinal.
                                </li>
                                <li class="view-classification-li">
                                    <strong>Tóxica:</strong> possui substâncias que podem causar irritação,
                                    intoxicação ou até envenenamento se ingerida ou em contato com a pele/olhos.
                                </li>
                                <li class="view-classification-li">
                                    <strong>Interior:</strong> é adaptada para ser cultivada dentro de casas,
                                    escritórios ou ambientes fechados, pois tolera luz indireta ou meia-sombra.
                                </li>
                            </ul>
                        </div>
                    </section>

                    <section class="view-publication-container" id="viewAboutContainer">
                        <span>Sobre:</span>
                        <div class="view-input">
                            <p><?= $post->sobre ?></p>
                        </div>
                    </section>

                    <section class="view-publication-container" id="caresContainer">
                        <span>Cuidados:</span>
                        <div class="view-input view-input-cares">
                            <ul class="view-cares-ul">
                                <li class="view-care">Evite sol direto nas folhas, pois pode causar queimaduras.</li>
                                <li class="view-care">Mantenha o solo levemente úmido, mas nunca encharcado.</li>
                                <li class="view-care"> Utilize substrato rico em matéria orgânica e bem drenado.</li>
                                <li class="view-care">Evite correntes de ar frio e mudanças bruscas de temperatura.</li>
                            </ul>
                        </div>
                    </section>

                    <section class="buttons">
                        <button class="close-modal-view" id="btnCloseModalView"
                            onclick="fecharModal('modalViewPublication<?= $post->id ?>', 'filtro')">Fechar</button>
                    </section>

                </div>

            </div>

            <!-- MODAL EDITAR PUBLICAÇÃO -->
            <div class="modal-edit-publication" id="modalEditPublication">
                <div class="modal-edit-publication-header">
                    <i class="bi bi-pencil-square"></i>
                    <p>Editar publicação</p>
                </div>

                <div class="modal-edit-publication-main">
                    <form class="edit-publication-form" id="editPublicationForm">
                        <div class="selectPhoto">
                            <input type="file" name="trocar foto" id="changePhoto"
                                onchange="trocarPreviewImagem('changePhoto','label-content')">
                            <label for="changePhoto">
                                <div class="label-content" id="label-content">
                                    <img src="../../../public/assets/code-logo.png" alt="">
                                </div>
                            </label>
                        </div>
                        <div class="infosPost">
                            <div class="title editPublicationContainer">
                                <span>Título:</span>
                                <input type="text" placeholder="Digite o novo título da publicação..." class="modalEditInput">
                            </div>
                            <div class="description editPublicationContainer">
                                <span>Descrição:</span>
                                <input type="text" placeholder="Digite a nova descrição da publicação..." class="modalEditInput">
                            </div>
                            <div class="nameClass">
                                <div class="name editPublicationContainer">
                                    <span>Nome:</span>
                                    <input type="text" placeholder="Digite o nome da planta..." class="modalEditInput">
                                </div>
                                <div class="class editPublicationContainer">
                                    <span>Classificação:</span>
                                    <button type="button" id="mostarDropdown" onclick="abrirDropdown('dropDownClassificacao')">Escolha
                                        3 opções... <img src="../../../public/assets/arrow-down-icon.svg"
                                            alt="seta para baixo" class="icone-seta-baixo" id="iconeSetaBaixo"> <img
                                            src="../../../public/assets/arrow-up-icon.svg" alt="seta para cima"
                                            class="icone-seta-cima" id="iconeSetaCima"></button>
                                    <div class="dropDownClassificacao" id="dropDownClassificacao">
                                        <label><input type="checkbox" name="classification[]" id="">Ornamentais</label>
                                        <label><input type="checkbox" name="classification[]" id="">Medicinais</label>
                                        <label><input type="checkbox" name="classification[]" id="">Alimentícias</label>
                                        <label><input type="checkbox" name="classification[]" id="">Aromáticas</label>
                                        <label><input type="checkbox" name="classification[]" id="">Tóxicas</label>
                                        <label><input type="checkbox" name="classification[]" id="">Industriais</label>
                                        <label><input type="checkbox" name="classification[]" id="">Forrageiras</label>
                                        <label><input type="checkbox" name="classification[]" id="">Madeireiras</label>
                                        <label><input type="checkbox" name="classification[]" id="">Oleaginosas</label>
                                        <label><input type="checkbox" name="classification[]" id="">Fibrosas</label>
                                        <label><input type="checkbox" name="classification[]"
                                                id="">Condimentares</label>
                                    </div>
                                </div>
                            </div>
                            <div class="infosPlanta editPublicationContainer">
                                <span>Sobre:</span>
                                <input type="text" placeholder="Digite novas informações sobre a planta..." class="modalEditInput">
                            </div>
                            <div class="cares editPublicationContainer">
                                <span>Cuidados:</span>
                                <div class="inputEPlus">
                                    <input type="text" placeholder="Digite cuidados sobre a planta..." class="modalEditInput">
                                    <i class="bi bi-plus-circle"></i>
                                </div>
                                <ul id="ulCares" class="ul-cares"></ul>
                            </div>
                        </div>

                        <div class="buttons">
                            <div class="botaoCancelar">
                                <button type="button" onclick="fecharModal('modalEditPublication','filtro')">Cancelar</button>
                            </div>

                            <div class="botaoEditar">
                                <button type="submit">Editar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- MODAL EXCLUIR PUBLICAÇÃO -->
            <div class="modal-delete-publication" id="modalDeletePublication">
                <div class="modal-delete-publication-header">
                    <i class="bi bi-trash"></i>
                    <p>Excluir publicação</p>
                </div>

                <div class="modal-delete-publication-main">
                    <form class="delete-publication-form" id="deletePublicationForm">
                        <div class="text">
                            <p>Tem certeza que deseja excluir essa publicação?</p>
                        </div>

                        <div class="buttonsExcluir">
                            <div class="botaoCancelarExcluir">
                                <button type="button" onclick="fecharModal('modalDeletePublication','filtro')">Cancelar</button>
                            </div>
                            <div class="botaoExcluir">
                                <button>Excluir</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

        <!-- JAVASCRIPT -->
        <script src="../../../public/js/modalCriarPublicacao.js"></script>
        <script src="../../../public/js/modal.js"></script>
        <script src="../../../public/js/modalEditarPublicacao.js"></script>

</body>

</html>