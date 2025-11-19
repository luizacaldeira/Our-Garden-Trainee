const id_logo_ourgarden =document.getElementById("id_logo_ourgarden");
const btnDashboard = document.getElementById("btnDashboard");
const btnUsuarios = document.getElementById("btnUsuarios");
const btnPublicacoes = document.getElementById("btnPublicacoes");
const vazio = document.getElementById("vazio");

btnUsuarios.addEventListener("click", () => {
    btnUsuarios.classList.add('active');
    
    btnDashboard.classList.remove('active');
    btnPublicacoes.classList.remove('active');

    id_logo_ourgarden.style.borderBottomRightRadius = "0px";
    vazio.style.borderTopRightRadius = "0px";

    btnDashboard.style.borderBottomRightRadius = "50px";
    btnPublicacoes.style.borderTopRightRadius = "50px";
})