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
