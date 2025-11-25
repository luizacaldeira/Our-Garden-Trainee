
// FUNÇÃO QUE ABRE E FECHA O DROPDOWN
function abrirDropdown(id) {
    const dropdown = document.getElementById(`dropDownClassificacao${id}`);
    const setaCima = document.getElementById(`iconeSetaCima${id}`);
    const setaBaixo = document.getElementById(`iconeSetaBaixo${id}`);
    const btnMostrarDropdown = document.getElementById(`mostarDropdown${id}`);

    dropdown.classList.toggle('open');

    if (dropdown.classList.contains('open')) {
        setaBaixo.style.display = 'none';
        setaCima.style.display = 'block';
    }
    else {
        setaBaixo.style.display = 'block';
        setaCima.style.display = 'none';
    }

    // chama a funcao que limita a escolha de no máximo 3 checkboxs de classificacoes somente ao abrir o modal
    const checkboxSetups = [{ groupName: "classificationEdit[]", limit: 3 }];
    checkboxSetups.forEach((setup) => {
        limitCheckboxSelectionEdited(setup.groupName, setup.limit);
    });

    // chama a funcao que fecha o dropdown ao clicar fora dele
    closeDropdownClickOutside(dropdown, btnMostrarDropdown, setaCima, setaBaixo);
}

// Fecha o dropdown ao clicar fora dele
function closeDropdownClickOutside(dropdown_classification, btn_classification, arrow_up_icon, arrow_down_icon) {
    document.addEventListener('click', (event) => {
        const clickedOutside = !dropdown_classification.contains(event.target) && !btn_classification.contains(event.target);

        if (clickedOutside && dropdown_classification.classList.contains('open')) {
            dropdown_classification.classList.remove('open');
            arrow_down_icon.style.display = "block";
            arrow_up_icon.style.display = "none";
        }
    });
}

// FUNÇÃO QUE LIMITA O MAXIMO DE 3 OPÇÕES DE ESCOLHA DE CLASSIFICAÇÃO
function limitCheckboxSelectionEdited(groupName, limit) {
    const checkboxes = document.querySelectorAll(`input[name="${groupName}"]`);

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            const dropdown = checkbox.closest('.dropDownClassificacao');
            const checkedCount = dropdown.querySelectorAll(`input[name="${groupName}"]:checked`).length;

            console.log(checkedCount);

            if (checkedCount > limit) {
                checkbox.checked = false;
            }
        });
    });
}

// FUNÇÃO PARA TROCAR PREVIEW DA IMAGEM
function trocarPreviewImagem(idInput, idLabelContent) {
    if (idInput) {
        const input = document.getElementById(idInput);
        const reader = new FileReader();
        const imgSrc = input.files[0];

        if (imgSrc) {
            reader.onload = (e) => {
                const preview = document.getElementById(idLabelContent);
                preview.innerHTML = `<img class="preview-image" src="${e.target.result}" alt="previsualização">`;
            }

            reader.onerror = (e) => {
                console.error("deu erro");
            }

            reader.readAsDataURL(imgSrc);
        }
    }
}

// FUNÇÃO QUE VAI ADICIONAR CUIDADOS
const caresUpdate = [];
let contUpdate = -1;

function addCaresUpdate(id) {
    const careInput = document.getElementById(`careInput${id}`);
    const ulCares = document.getElementById(`ulCares${id}`);
    const inputBox = document.getElementById(`inputEPlus${id}`);

    console.log(ulCares.children.length);

    if (careInput.value.trim() === "") {
        alert("Preencha o campo antes de adicionar um cuidado.");
    }

    const inputCaresEdit = document.createElement("input");
    inputCaresEdit.className = "li-cares-edit";
    inputCaresEdit.name = "cuidados[]";
    inputCaresEdit.value = `${careInput.value}`;

    const li = document.createElement("li");
    li.classList.add("li-cares-update");
    li.setAttribute("id", contUpdate + 1);
    li.appendChild(inputCaresEdit);

    const delete_li_cares = document.createElement("i");
    delete_li_cares.setAttribute("alt", "ícone de lixeira");
    delete_li_cares.setAttribute("class", "bi bi-trash-fill");
    li.appendChild(delete_li_cares);

    caresUpdate.push({ id: contUpdate + 1, content: careInput.value });
    contUpdate++;
    ulCares.appendChild(li);
    careInput.value = "";

    // funcao que vai deletar cuidados que o usuario adicionar no frontend
    delete_li_cares.addEventListener("click", () => {
        const caresExclusao = caresUpdate.findIndex(care => care.id === Number(li.id));
        if (caresExclusao != -1) {
            caresUpdate.splice(caresExclusao, 1);
            updateCares();
        }
        ulCares.removeChild(li);
        if (ulCares.children.length <= 5) {
            inputBox.style.display = "flex";
        }
    });

    if (ulCares.children.length >= 5) {
        inputBox.style.display = "none";
    }

}

// FUNÇÃO QUE VAI DELETAR CUIDADOS QUE VEM DO BANCO
function deleteCaresUpdate(id, postId) {
    const ulCares = document.getElementById(`ulCares${postId}`);
    const inputBox = document.getElementById(`inputEPlus${postId}`);
    const li = document.getElementById(id);
    if (li) {
        li.remove();

        if (ulCares.children.length <= 5) {
            inputBox.style.display = "flex";
        }
    }
}

function fecharModalUpdate(idModal, idFundo) {
    //console.log("sai da funcao");
    document.getElementById(idModal).style.display = "none";
    document.getElementById(idFundo).style.display = "none";

    window.location.reload();
}
