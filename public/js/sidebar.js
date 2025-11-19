const id_logo_ourgarden =document.getElementById("id_logo_ourgarden");
const btnDashboard = document.getElementById("btnDashboard");
const btnUsuarios = document.getElementById("btnUsuarios");
const btnPublicacoes = document.getElementById("btnPublicacoes");
const vazio = document.getElementById("vazio");

const btnDashboardContainer= document.getElementById("btnDashboardContainer");
const btnUsuariosContainer= document.getElementById("btnUsuariosContainer");
const btnPublicacoesContainer = document.getElementById("btnPublicacoesContainer");

btnDashboard.addEventListener("click", () => {
    btnDashboard.classList.add('active');
    
    btnUsuarios.classList.remove('active');
    btnPublicacoes.classList.remove('active');
    
    id_logo_ourgarden.style.borderBottomRightRadius = "20px";
    btnUsuariosContainer.style.borderTopRightRadius = "20px";

    btnUsuariosContainer.style.borderBottomRightRadius = "0px";
    btnPublicacoesContainer.style.borderTopRightRadius = "0px";
    vazio.style.borderTopRightRadius = "0px";

});

btnUsuarios.addEventListener("click", () => {
    btnUsuarios.classList.add('active');
    
    btnDashboard.classList.remove('active');
    btnPublicacoes.classList.remove('active');
    
    btnDashboardContainer.style.borderBottomRightRadius = "20px";
    btnPublicacoesContainer.style.borderTopRightRadius = "20px";

    id_logo_ourgarden.style.borderBottomRightRadius = "0px";
    vazio.style.borderTopRightRadius = "0px";
});

btnPublicacoes.addEventListener("click", () => {
    btnPublicacoes.classList.add('active');
    
    btnDashboard.classList.remove('active');
    btnUsuarios.classList.remove('active');
    
    btnUsuariosContainer.style.borderBottomRightRadius = "20px";
    vazio.style.borderTopRightRadius = "20px";

    id_logo_ourgarden.style.borderBottomRightRadius = "0px";
    btnPublicacoesContainer.style.borderTopRightRadius = "0px";
    btnUsuariosContainer.style.borderTopRightRadius = "0px";
    btnDashboardContainer.style.borderBottomRightRadius = "0px";
});