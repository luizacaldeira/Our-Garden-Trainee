const olho = document.getElementById('olho');
const olhoAberto = document.getElementById('olhoAberto');
const divOlhos = document.getElementById('divOlhos');
const inputLoginPassword = document.getElementById('inputLoginPassword');

divOlhos.addEventListener("click", () => {
    if(inputLoginPassword.type == "password"){
        inputLoginPassword.setAttribute("type", "text");
        olhoAberto.style.display = "none";
        olho.style.display = "block";
    }else{
        inputLoginPassword.setAttribute("type", "password");
        olhoAberto.style.display = "block";
        olho.style.display = "none";
    }

});