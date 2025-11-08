const setaCima = document.getElementById('iconeSetaCima');
const setaBaixo = document.getElementById('iconeSetaBaixo');

// FUNÇÃO QUE ABRE E FECHA O DROPDOWN
function abrirDropdown (idDropdown){
    const dropdown = document.getElementById(idDropdown);
    dropdown.classList.toggle('open');

    if (dropdown.classList.contains('open')){
        setaBaixo.style.display = 'none';
        setaCima.style.display = 'block';
    }
    else {
        setaBaixo.style.display = 'block';
        setaCima.style.display = 'none';
    }
}

// FUNÇÃO QUE LIMITA O MAXIMO DE 3 OPÇÕES DE ESCOLHA DE CLASSIFICAÇÃO
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

    const checkboxSetups = [{ groupName: "classification[]", limit: 3 }];

  checkboxSetups.forEach((setup) => {
    limitCheckboxSelection(setup.groupName, setup.limit);
  });
});

// FUNÇÃO PARA TROCAR PREVIEW DA IMAGEM
function trocarPreviewImagem (idInput, idLabelContent){
    if (idInput){
        const input = document.getElementById(idInput);
        const reader = new FileReader();
        const imgSrc = input.files[0];

        if (imgSrc){
            reader.onload = (e) => {
                const preview = document.getElementById(idLabelContent);
                preview.innerHTML = `<img class="preview-image" src="${e.target.result}" alt="previsualização">`;
            }

            reader.onerror = (e) => {
                console.error ("deu erro");
            }

            reader.readAsDataURL(imgSrc);
        }
    }
}