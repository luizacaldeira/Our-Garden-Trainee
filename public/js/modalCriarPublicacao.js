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
const imagePreview = document.querySelector("#previewContent");

btn_cancel_publication.addEventListener("click", (event) => {
  event.preventDefault();
  modal_create_publication.style.display = "none";
  filtro.style.display = "none";

  create_publication_form.reset(); // reseta os campos do formulario
  imagePreview.innerHTML = `<img src="../../../public/assets/image-icon.svg"
                                            alt="ícone de adicionar nova imagem">
                                        <p>Selecione uma foto</p>`;  // Retira a imagem que o usuário selecionou
});

// Exibir preview imagem selecionada
function exibirPreviewImagem(idInput, idPreviewContent) {
  if (idInput) {
    const id_input = document.getElementById(idInput);
    const reader = new FileReader(); // leitor de arquivos
    const imageSrc = id_input.files[0];

    if (imageSrc) {
      reader.onload = (e) => {
        const preview = document.getElementById(idPreviewContent);
        preview.innerHTML = `<img class="preview-image" src="${e.target.result}" alt="previsualização">`;
      }

      reader.onerror = (e) => {
        console.error("Deu erro");
      }

      reader.readAsDataURL(imageSrc);
    }
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
const ul_cares = document.querySelector("#ulCares");
const cares = [];
let cont = -1;

btn_add_cares.addEventListener("click", (event) => {
  event.preventDefault();

  const delete_li_cares = document.createElement("img");
  delete_li_cares.setAttribute("src", "../../../public/assets/trash-icon.svg");
  delete_li_cares.setAttribute("alt", "ícone de lixeira");
  delete_li_cares.setAttribute("class", "delete-li-cares");
  
  const liCares = document.createElement("li");
  liCares.setAttribute("class", "li-cares");
  liCares.setAttribute("id", cont+1);
  liCares.innerHTML = input_cares_plant.value;
  liCares.appendChild(delete_li_cares);

  if (input_cares_plant.value.trim() != '') {
    cares.push({ id: cont+1, content: input_cares_plant.value });
    cont++;
    ul_cares.appendChild(liCares);
  } else {
    alert("Preencha os campos do formulario antes de adicionar um novo cuidado.");
  }

   if(cares.length >= 5) {
    input_cares_plant.style.display = "none";
    btn_add_cares.style.display = "none";
  } 

  input_cares_plant.value = '';

  delete_li_cares.addEventListener("click", () => {
    const caresExclusao = cares.findIndex(care => care.id === Number(liCares.id));
    if(caresExclusao != -1) cares.splice(caresExclusao, 1);
    ul_cares.removeChild(liCares);
    
    if(cares.length < 5 && input_cares_plant.style.display == "none" && btn_add_cares.style.display == "none") {
      input_cares_plant.style.display = "block";
      btn_add_cares.style.display = "block";
    }
  });

});
