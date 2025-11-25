// Faz aparecer informações adicionais sobre a planta
const btn_show_more = document.querySelector("#btn-show-more");
const plant_infos_container = document.querySelector(".plant-infos-container");
btn_show_more.addEventListener('click', () => {
    plant_infos_container.classList.toggle('open');

    if (plant_infos_container.classList.contains('open')) {
        return btn_show_more.innerHTML = `<img src="../../../public/assets/arrow-up-icon.svg" alt="seta para cima"></img>`;
    }

    setTimeout(() => {
      btn_show_more.innerHTML = `
        <img src="../../../public/assets/arrow-down-icon.svg" alt="Seta para baixo">
        Saiba mais sobre a planta
      `;
    }, 400); 
});