// Faz abrir o modal de criar nova publicação
const botoes_lista_posts = document.querySelector("#botoeslistaPosts");
const modal_create_publication = document.querySelector("#modalCreatePublication");
const filtro = document.querySelector("#filtro");
botoes_lista_posts.addEventListener("click", () => {
    modal_create_publication.style.display = "flex";
    filtro.style.display = "block";
});

// Faz fechar o modal de criar nova publicação
const btn_cancel_publication = document.querySelector("#btnCancelPublication");
btn_cancel_publication.addEventListener("click", (event) => {
    event.preventDefault();
    modal_create_publication.style.display = "none";
    filtro.style.display = "none";
})

// Faz aparecer as opções de classificação da planta do modal de criar nova publicação
const btn_classification = document.querySelector("#btnClassification");
const dropdown_classification = document.querySelector("#dropdownClassification");
const arrow_down_icon = document.querySelector("#arrowDownIcon");
const arrow_up_icon = document.querySelector("#arrowUpIcon");
btn_classification.addEventListener('click', (event) => {
    event.preventDefault();
    dropdown_classification.classList.toggle('open');

    if (arrow_down_icon.style.display != "none") {
        arrow_down_icon.style.display = "none";
        arrow_up_icon.style.display = "block";
    } else {
        arrow_down_icon.style.display = "block";
        arrow_up_icon.style.display = "none";
    }
});

// Exibir preview imagem selecionada
function exibirPreviewImagem(idInput, idLabelContent) {
    console.log("entrei na função");
    if (idInput) {
        const id_input = document.getElementById(idInput);
        console.log(idInput);
            const reader = new FileReader(); // leitor de arquivos
            console.log(reader);
            const imageSrc = id_input.files[0];
            console.log(imageSrc);

            if (imageSrc) {
                reader.onload = function (e) {
                    console.log(imageSrc);
                    const preview = document.getElementById(idLabelContent);
                    console.log("preview" + preview);
                    preview.innerHTML = `<img class="preview-image" src="${e.target.result}" alt="previsualização">`;
                }

                reader.onerror = function (e) {
                    console.error("Deu erro");
                }

                reader.readAsDataURL(imageSrc);
            }
            console.log("arquivo nulo")
    }
}