const fomulario = document.getElementById('editPublicationForm');
fomulario.addEventListener('submit', (event) =>{
    event.preventDefault();
})

const arrowUp = document.getElementById('arrowUpIcon');
const arrowDown = document.getElementById('arrowDownIcon');

// FUNÇÃO QUE ABRE E FECHA O DROPDOWN
function abrirDropdown (idDropdown){
    document.getElementById(idDropdown).classList.toggle('open');

    // arrowDown.style.display = 'none';
    // arrowUp.style.display = 'block';
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