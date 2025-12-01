document.getElementById("input-search").addEventListener("keyup", function () {
    let termo = this.value;

    fetch(`/posts/buscaPublicacoes?pesquisarPublicacoes=${encodeURIComponent(termo)}&paginacaoNumero=1`)
        .then(res => res.json())
        .then(data => {
            atualizarTabela(data.posts);
            atualizarPaginacao(data.page, data.total_pages, termo);
        });
});

function atualizarTabela(posts) {
    let tbody = document.querySelector(".tabelaPosts tbody");
    tbody.innerHTML = "";

    posts.forEach(post => {
        tbody.innerHTML += `
            <tr>
                <td>${post.id}</td>
                <td><strong>${post.titulo}</strong></td>
                <td>${post.usuarios_id}</td>
                <td>${new Date(post.data_criacao).toLocaleDateString('pt-BR')}</td>
                <td>
                    <div class="botoesAcoes">
                        <button class="btn-actions">
                            <img src="../../../public/assets/eye-icon.svg" onclick="abrirModal('modalViewPublication${post.id}', 'filtro')">
                        </button>
                        <button class="btn-actions">
                            <img src="../../../public/assets/pencil-icon.svg" onclick="abrirModal('modalEditPublication${post.id}','filtro')">
                        </button>
                        <button class="btn-actions">
                            <img src="../../../public/assets/trash-icon.svg" onclick="abrirModal('modalDeletePublication${post.id}','filtro')">
                        </button>
                    </div>
                </td>
            </tr>
        `;
    });
}

function atualizarPaginacao(page, totalPages, termo) {
    let div = document.querySelector(".paginacaoPostsConteudo");

    let anterior = page > 1 ? page - 1 : 1;
    let proxima = page < totalPages ? page + 1 : totalPages;

    let botoes = `
        <li class="page-item ${page <= 1 ? "disabled" : ""}">
            <a class="arrow-left" onclick="mudarPagina(${anterior}, '${termo}')">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>
        <div class="pages">
    `;

    for (let i = 1; i <= totalPages; i++) {
        botoes += `
            <li class="page-item">
                <a class="page ${i === page ? "active" : ""}" onclick="mudarPagina(${i}, '${termo}')">
                    ${i}
                </a>
            </li>
        `;
    }

    botoes += `
        </div>
        <li class="page-item ${page >= totalPages ? "disabled" : ""}">
            <a class="arrow-right" onclick="mudarPagina(${proxima}, '${termo}')">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    `;

    div.innerHTML = botoes;
}

function mudarPagina(pagina, termo) {
    fetch(`/posts/buscaPublicacoesAjax?pesquisarPublicacoes=${encodeURIComponent(termo)}&paginacaoNumero=${pagina}`)
        .then(res => res.json())
        .then(data => {
            atualizarTabela(data.posts);
            atualizarPaginacao(data.page, data.total_pages, termo);
        });
}