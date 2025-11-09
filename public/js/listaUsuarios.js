function trocarPreviewImagem (idInput, idLabelContent){
    if (idInput){
        const input = document.getElementById(idInput);
        const reader = new FileReader();
        const imgSrc = input.files[0];

        if (imgSrc){
            reader.onload = (e) => {
                const preview = document.getElementById(idLabelContent);
                preview.innerHTML = <img class="preview-image" src="${e.target.result}" alt="previsualização">;
            }

            reader.onerror = (e) => {
                console.error ("deu erro");
            }

            reader.readAsDataURL(imgSrc);
        }
    }
}
