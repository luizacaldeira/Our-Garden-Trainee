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
const create_publication_form = document.querySelector("#createPublicationForm");
btn_cancel_publication.addEventListener("click", (event) => {
    event.preventDefault();
    modal_create_publication.style.display = "none";
    filtro.style.display = "none";

    create_publication_form.reset(); // reseta os campos do formulario
    add_cares_container.removeChild(ulCares); // remove as opções de cuidado com a planta
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
                reader.onload = (e) => {
                    console.log(imageSrc);
                    const preview = document.getElementById(idLabelContent);
                    console.log("preview" + preview);
                    preview.innerHTML = `<img class="preview-image" src="${e.target.result}" alt="previsualização">`;
                }

                reader.onerror = (e) => {
                    console.error("Deu erro");
                }

                reader.readAsDataURL(imageSrc);
            }
            console.log("arquivo nulo")
    }
}

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

// Limita o máximo de 3 opções de escolha de classificação
/**
 * Código disponível em: https://gist.github.com/dantetesta/590f6719400d57001380c9ca017982b3
 */
document.addEventListener("DOMContentLoaded", () => {
function limitCheckboxSelection(groupName, limit) {
  const checkboxes = document.querySelectorAll(`input[name="${groupName}"]`);

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', () => {
      const checkedCount = document.querySelectorAll(`input[name="${groupName}"]:checked`).length;

      if (checkedCount > limit) {
        checkbox.checked = false;
      }
    });
  });
}

const checkboxSetups = [
  { groupName: "classification[]", limit: 3 },
];

checkboxSetups.forEach((setup) => {
  limitCheckboxSelection(setup.groupName, setup.limit);
});
});

// Cria as opções de cuidados com a planta
const input_cares_plant = document.querySelector("#inputCaresPlant");
const btn_add_cares = document.querySelector("#btnAddCares");
const add_cares_container = document.querySelector("#addCaresContainer");
btn_add_cares.addEventListener("click", (event) => {
  event.preventDefault();

  const ulCares = document.createElement("ul");
  ulCares.setAttribute("class", "ul-cares");
  ulCares.setAttribute("id", "ulCares");

  add_cares_container.appendChild(ulCares);

  const liCares = document.createElement("li");
  liCares.setAttribute("class", "li-cares");
  liCares.setAttribute("id", "liCares")
  liCares.innerHTML = `${input_cares_plant.value}`;

  ulCares.appendChild(liCares);

  input_cares_plant.value = '';
});