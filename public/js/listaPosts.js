// Faz aparecer as opções de classificação da planta
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