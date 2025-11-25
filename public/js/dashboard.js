const arrow = document.querySelector(".arrow"); 
const setaParaBaixo = document.querySelector(".setaParaBaixo");
const setaParaCima = document.querySelector(".setaParaCima");
const dropdownLogout = document.querySelector(".dropdownLogout");

arrow.addEventListener("click", () => {
    if (setaParaBaixo.style.display === "block" || setaParaBaixo.style.display === "") {
        setaParaBaixo.style.display = "none";
        setaParaCima.style.display = "block";
    } else {
        setaParaCima.style.display = "none";
        setaParaBaixo.style.display = "block";
    }

    dropdownLogout.classList.toggle("open");
});


// Fecha o dropdown ao clicar fora dele
document.addEventListener('click', (event) => {
  const clickedOutside =
    !dropdownLogout.contains(event.target) &&
    !arrow.contains(event.target);

  if (clickedOutside && dropdownLogout.classList.contains('open')) {
    dropdownLogout.classList.remove('open');
    setaParaBaixo.style.display = "block";
    setaParaCima.style.display = "none";
  }
});