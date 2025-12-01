const navbarContentMobile = document.getElementById('navbarContentMobile');
const abrirSanduba = document.getElementById('abrirSanduba');
const fecharSanduba = document.getElementById('fecharSanduba');

abrirSanduba.addEventListener('click', ()=>{
    abrirSanduba.style.display="none";
    fecharSanduba.style.display="flex";
    navbarContentMobile.style.display="flex";
});

fecharSanduba.addEventListener('click', ()=>{
    fecharSanduba.style.display="none";
    abrirSanduba.style.display="flex";
    navbarContentMobile.style.display="none";
});