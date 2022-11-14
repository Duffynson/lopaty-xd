
const table = document.querySelector('.users-table');

const roles = {
    0: 'Autor',
    1: 'Recenzent',
    2: 'Redaktor',
    3: 'Šéfredaktor',
    4: 'Administrátor'
}

const renderUsers = async () => {
    try {
        const response = await fetch('./php/request_users.php', {method: 'GET'});
        const usersData = await response.json();
        const tbody = document.createElement('tbody');
        usersData.forEach(user => {
            const el = document.createElement('tr');
            el.innerHTML = `
                <td scope="col" class="user_id px-3">${user.ID_user}</td>
                <td scope="col" class="firstname">${user.firstname}</td>
                <td scope="col" class="lastname">${user.lastname}</td>
                <td scope="col" class="email">${user.email}</td>
                <td scope="col" class="role">${roles[user.role]}</td>
                <td scope="col" class="actions"><a href="./user?id=${user.ID_user}"><i class="fa-solid fa-pen-to-square"></i></a> </td>
            `; 
            tbody.appendChild(el);
        })
        table.firstElementChild.classList.remove('d-none');
        table.appendChild(tbody);
    } catch(e) {
        document.querySelector('.users-table').remove()
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat'
    }
}

renderUsers();
