const arrowUp = document.getElementById('arrowUpIcon');
const arrowDown = document.getElementById('arrowDownIcon');

function abrirDropdown (idDropdown,event){
    event.preventDefault();
    document.getElementById(idDropdown).classList.toggle('open');

    arrowDown.style.display = 'none';
    arrowUp.style.display = 'block';

}
