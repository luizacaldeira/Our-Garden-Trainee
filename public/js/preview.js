// Exibir preview imagem selecionada
function exibirPreviewImagem(idInput, idLabelContent) {
  if (idInput) {
    const id_input = document.getElementById(idInput);
    const reader = new FileReader(); // leitor de arquivos
    const imageSrc = id_input.files[0];

    if (imageSrc) {
      reader.onload = (e) => {
        const preview = document.getElementById(idLabelContent);
        preview.innerHTML = `<img class="preview-image" src="${e.target.result}" alt="previsualização">`;
      }

      reader.onerror = (e) => {
        console.error("Deu erro");
      }

      reader.readAsDataURL(imageSrc);
    }
    console.log(idLabelContent);
  }
}
