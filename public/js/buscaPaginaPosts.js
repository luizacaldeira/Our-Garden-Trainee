const urlParams = new URLSearchParams(window.location.search);
const termoBusca = urlParams.get('pesquisarPublicacoes');
if (termoBusca) {
    document.getElementById("input-search").value = termoBusca;
}

document.getElementById("input-search").addEventListener("keyup", function (e) {
    if (e.key === 'Enter') {
        let termo = this.value;

        if (termo.trim() === '') {
            window.location.href = '/publicacoes';
        } else {
            window.location.href = `/publicacoes?pesquisarPublicacoes=${encodeURIComponent(termo)}&page=1`;
        }
    }
});