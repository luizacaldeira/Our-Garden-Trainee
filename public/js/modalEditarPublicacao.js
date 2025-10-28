const arrowUp = document.getElementById('arrowUpIcon');
const arrowDown = document.getElementById('arrowDownIcon');

function abrirDropdown (idDropdown,event){
    console.log(event);
    event.preventDefault();
    document.getElementById(idDropdown).classList.toggle('open');

    // arrowDown.style.display = 'none';
    // arrowUp.style.display = 'block';
}

document.addEventListener("DOMContentLoaded", () => {
    function limitCheckboxSelection(groupName, limit) {
    const checkboxes = document.querySelectorAll(`input[name="${groupName}"]`);

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
            const checkedCount = document.querySelectorAll(`input[name="${groupName}"]:checked`).length;

            if (checkedCount > limit) {
                checkbox.checked = false;
        }
    });
    });
  }

    const checkboxSetups = [{ groupName: "classification[]", limit: 3 }];

  checkboxSetups.forEach((setup) => {
    limitCheckboxSelection(setup.groupName, setup.limit);
  });
});

