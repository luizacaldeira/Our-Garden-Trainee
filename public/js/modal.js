function abrirModal(idModal, idFundo){
    //console.log("entrei na funcao");
    document.getElementById(idModal).style.display = "flex";
    document.getElementById(idFundo).style.display = "flex";
}

function fecharModal(idModal, idFundo){
    //console.log("sai da funcao");
    document.getElementById(idModal).style.display = "none";
    document.getElementById(idFundo).style.display = "none";
}
